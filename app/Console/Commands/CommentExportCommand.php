<?php

namespace App\Console\Commands;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Revolution\Google\Sheets\Facades\Sheets;

class CommentExportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-export:comment {--startDate= : Start date} {--endDate= : End date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export to google sheets the comments in a date range.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $startDate = Carbon::now();
        if(!is_null($this->option('startDate'))){
            $startDate = Carbon::parse($this->option('startDate'));
        }
        $endDate = Carbon::now();
        if(!is_null($this->option('endDate'))){
            $endDate = Carbon::parse($this->option('endDate'));
        }
        $comments = Comment::query()
            ->whereBetween(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'),
                [
                    $startDate->toDateString(),
                    $endDate->toDateString()
                ]
            )->get();
        $data = [];
        foreach ($comments as $comment) {
            $data[] = [
                'origen' => $comment->toAny(),
                'content' => $comment->content,
            ];
        }
        try {
            Sheets::sheet(trans_choice('models/comment.module', 2))->append($data);
        } catch (\Throwable $exception) {
            $this->comment($exception->getMessage());
        }

        return Command::SUCCESS;
    }
}
