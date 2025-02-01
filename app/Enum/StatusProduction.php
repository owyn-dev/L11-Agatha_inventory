<?php

namespace App\Enum;

enum StatusProduction: string
{
    case WAITING_FOR_RESPONSE = 'waiting_for_response';
    case IN_PROGRESS = 'in_progress';
    case COMPLETE = 'complete';
    case PENDING_APPROVAL = 'pending_approval';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public static function default(): self
    {
        return self::WAITING_FOR_RESPONSE;
    }

    public function label(): string
    {
        return match ($this) {
            self::WAITING_FOR_RESPONSE => 'Waiting for Response',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETE => 'Complete',
            self::PENDING_APPROVAL => 'Pending Approval',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
        };
    }

    public function getBadgeClass()
    {
        switch ($this) {
            case StatusProduction::WAITING_FOR_RESPONSE:
                return 'bg-secondary';
            case StatusProduction::IN_PROGRESS:
                return 'bg-warning';
            case StatusProduction::COMPLETE:
                return 'bg-success';
            case StatusProduction::PENDING_APPROVAL:
                return 'bg-info';
            case StatusProduction::APPROVED:
                return 'bg-primary';
            case StatusProduction::REJECTED:
                return 'bg-danger';
            default:
                return 'bg-secondary';
        }
    }
}
