<?php

namespace App\Repositories;

use App\Models\PartnerBankTransfer;

class PartnerBankTransferRepository extends BaseRepository
{
    public function model()
    {
        return PartnerBankTransfer::class;
    }

    public function checkBbdsId(string $bbdsId)
    {
        $return = [
            'success' => false,
            'message' => null
        ];
        $transfer = $this->model->where('bbds_id', $bbdsId)
            ->whereIn('status', [PartnerBankTransfer::STATUS_PENDING, PartnerBankTransfer::STATUS_SUCCESS])
            ->first();
        if ($transfer) {
            $status = $transfer->status === PartnerBankTransfer::STATUS_PENDING ? 'Chờ xử lý' : 'Đã xử lý';
            $return['message'] = "Không thể tạo mới vì biên bản đối soát với mã $bbdsId đang ở trạng thái \"$status\"";
        } else {
            $return['success'] = true;
        }
        return $return;
    }

    public function transactions(int $page = 1, int $limit = 10, array $filter = []): array
    {
        $return = [
            'page' => $page,
            'limit' => $limit,
            'total' => 0,
            'data' => [],
        ];

        ## get payment
        $offset = ($page - 1) * $limit;
        $items = $this->model->select('*');
        $this->getListTransactionFilterConditions($items, $filter);
        $isExport = isset($filter['export']) && $filter['export'];
        if (!$isExport) {
            $items->limit($limit)->offset($offset);
        }
        $items = $items->orderByDesc('id')->get();
        $return['data'] = $items->toArray();

        ## get total
        if (!$isExport && $items->isNotEmpty()) {
            $total = $this->model->select('*');
            $this->getListTransactionFilterConditions($total, $filter);
            $total = $total->get()->count();
            $return['total'] = $total;
        }

        return $return;
    }

    private function getListTransactionFilterConditions(&$query, array $filter)
    {
        $filter = array_filter($filter);
        if (isset($filter['id'])) {
            $query->where('id', $filter['id']);
        }
        if (isset($filter['status'])) {
            $query->where('status', $filter['status']);
        }
        if (isset($filter['bbds_id'])) {
            $query->where('bbds_id', $filter['bbds_id'])->whereIn('status', [PartnerBankTransfer::STATUS_PENDING, PartnerBankTransfer::STATUS_SUCCESS]);
        }
        if (isset($filter['partner_code'])) {
            $query->where('partner_code', $filter['partner_code']);
        }
        if (isset($filter['bank_account_name'])) {
            $query->where('bank_account_name', $filter['bank_account_name']);
        }
        if (isset($filter['bank_account_no'])) {
            $query->where('bank_account_no', $filter['bank_account_no']);
        }
        if (isset($filter['bank_account_type'])) {
            $query->where('bank_account_type', $filter['bank_account_type']);
        }
        if (isset($filter['bank_code'])) {
            $query->where('bank_code', $filter['bank_code']);
        }
        if (isset($filter['fd'])) {
            $query->whereRaw("DATE(created_at) >= '{$filter['fd']}'");
        }
        if (isset($filter['td'])) {
            $query->whereRaw("DATE(created_at) <= '{$filter['td']}'");
        }
    }
}
