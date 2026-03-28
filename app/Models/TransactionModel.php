<?php namespace App\Models;
use CodeIgniter\Model;
class TransactionModel extends Model {
    protected $table = 'transactions';
    protected $allowedFields = ['transaction_id', 'program_id', 'donor_name', 'donor_email', 'donor_phone', 'amount', 'payment_method', 'status', 'midtrans_transaction_id', 'midtrans_response', 'proof_image'];
    protected $useTimestamps = true;
}
