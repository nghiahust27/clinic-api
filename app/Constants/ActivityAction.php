<?php
namespace App\Constants;

class ActivityAction
{
    public const USER_CREATED = 'user.created';
    public const USER_UPDATED = 'user.updated';
    public const USER_DEACTIVATED = 'user.deactivated';

    public const APPOINTMENT_STATUS_UPDATED = 'appointment.status_updated';

    public const EXAMINATION_CREATED = 'examination.created';
    public const EXAMINATION_UPDATED = 'examination.updated';

    public const PRESCRIPTION_CREATED = 'prescription.created';
    public const PRESCRIPTION_ITEM_ADDED = 'prescription.item_added';
    public const PRESCRIPTION_ITEM_UPDATED = 'prescription.item_updated';
    public const PRESCRIPTION_ITEM_REMOVED = 'prescription.item_removed';

    public const STOCK_ADJUSTED = 'medicine.stock_adjusted';

    public const INVOICE_CREATED = 'invoice.created';
    public const INVOICE_UPDATED = 'invoice.updated';

    public const PAYMENT_CREATED = 'payment.created';
    public const PAYMENT_COMPLETED = 'payment.completed';
    public const PAYMENT_FAILED = 'payment.failed';
}