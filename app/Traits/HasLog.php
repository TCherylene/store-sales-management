<?php

namespace App\Traits;

trait HasLog
{
    public function createdBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function formatLog($date, $user): string
    {
        return sprintf(
            '%s (%s)',
            $date?->format('Y-m-d H:i') ?? '-',
            $user?->username ?? 'System'
        );
    }

    public function createdLog(): string
    {
        return $this->formatLog($this->created_at, $this->createdBy);
    }
}
