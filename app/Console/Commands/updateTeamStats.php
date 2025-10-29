<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Game;
use App\Models\Team;
use DB;

class updateTeamStats extends Command
{
    protected $signature = 'games:update-team-stats';
    protected $description = 'Update team stats based on completed games';

    public function handle()
    {
        $games = Game::where('game_status', 'c') // Played games
                     ->where('updated_stats', false) // Avoid reprocessing
                     ->get();

        foreach ($games as $game) {
            DB::transaction(function () use ($game) {
                $homeTeam = Team::find($game->team_id);
                $awayTeam = Team::find($game->away_team_id);

                if (!$homeTeam || !$awayTeam) return;

                // Update matches played
                $homeTeam->matches_played += 1;
                $awayTeam->matches_played += 1;

                // Update goal difference
                $homeTeam->goals += ($game->home_team_score - $game->away_team_score);
                $awayTeam->goals += ($game->away_team_score - $game->home_team_score);

                // Determine result from scores
                if ($game->home_team_score > $game->away_team_score) {
                    // Home win
                    $homeTeam->matches_won += 1;
                    $awayTeam->matches_lost += 1;
                    $homeTeam->points += 3;
                } elseif ($game->home_team_score < $game->away_team_score) {
                    // Away win
                    $awayTeam->matches_won += 1;
                    $homeTeam->matches_lost += 1;
                    $awayTeam->points += 3;
                } else {
                    // Draw
                    $homeTeam->matches_drawn += 1;
                    $awayTeam->matches_drawn += 1;
                    $homeTeam->points += 1;
                    $awayTeam->points += 1;
                }

                $homeTeam->save();
                $awayTeam->save();

                // Mark game as processed
                $game->updated_stats = true;
                $game->save();
            });
        }

        $this->info('Team stats updated successfully.');
    }
}




