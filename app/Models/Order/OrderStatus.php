<?php
namespace App\Models\Order;
use App\Utils\EnumArrayHelper;

enum OrderStatus: string
{
    use EnumArrayHelper;

    case Pending = "pending";
    case Processing = "processing";
    case Dispatched = "dispatched";
    case Shipped = "shipped";
    case Completed = "completed";
    case Cancelled = "cancelled";
}
