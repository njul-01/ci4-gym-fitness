<?php

namespace App\Models;

use CodeIgniter\Model;

class MembershipModel extends Model
{
    protected $table            = 'membership';
    protected $primaryKey       = 'membership_id';
    protected $useAutoIncrement = true;
    //protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'member_id',
        'type',
        'start_date',
        'end_date',
        'price',
        'status'
    ];


    // Dates
    protected $useTimestamps = false;

    public function getMembership($perPage, $group, $keyword = null) //Menampilkan data membership dengan pagination
    {
        // Join dengan tabel members untuk mendapatkan nama member
         $builder = $this->select('membership.*, members.name')
         ->join('members', 'members.member_id = membership.member_id')
         ->orderBy('membership.status', 'ASC');
        
        // Pencarian berdasarkan keyword
        if(!empty($keyword)){
            $builder = $builder->groupStart()
            ->like('membership.type', $keyword)
            ->orLike('membership.start_date', $keyword)
            ->orLike('membership.end_date', $keyword)
            ->orLike('membership.price', $keyword)
            ->orLike('membership.status', $keyword)
            ->orLike('members.name', $keyword)
            ->groupEnd();
        }
        return $builder->paginate($perPage, $group);
    } 

    public function getActiveMembership($member_id) // Mendapatkan membership aktif berdasarkan member_id
    {
        return $this->where('member_id', $member_id)
                    ->where('status', 'Active')
                    ->first();
    }


    public function hasActiveOrInactive($member_id, $exceptId = null) // Memeriksa apakah member memiliki membership aktif atau non-aktif kecuali ID tertentu
    {
    $builder = $this->where('member_id', $member_id) 
                    ->whereIn('status', ['Active', 'Inactive']); // Memeriksa status Active atau Inactive

                    if ($exceptId) {
                        $builder->where('membership_id !=', $exceptId);
                    }               
                    return $builder->first();
    }

    public function getLaporanMembershipBulanan($bulan, $tahun, $status = null)
{
    $builder = $this->db->table('membership m')
        ->select('
            m.membership_id,
            m.type,
            m.start_date,
            m.end_date,
            m.price,
            m.status,
            mem.member_code,
            mem.name as member_name
        ')
        ->join('members mem', 'mem.member_id = m.member_id')
        ->where('MONTH(m.start_date)', $bulan)
        ->where('YEAR(m.start_date)', $tahun);

    // filter status optional
    if (!empty($status)) {
        $builder->where('m.status', $status);
    }

    return $builder
        ->orderBy('m.start_date', 'ASC')
        ->get()
        ->getResultArray();
}

public function getLaporanMembership($bulan, $tahun)
{
    return $this->db->table('membership')
        ->select('
            membership.*,
            members.member_code,
            members.name AS member_name
        ')
        ->join('members', 'members.member_id = membership.member_id')
        ->where('MONTH(membership.start_date)', $bulan)
        ->where('YEAR(membership.start_date)', $tahun)
        ->orderBy('membership.start_date', 'ASC')
        ->get()
        ->getResultArray();
}

public function getTotalMembershipByPeriode($bulan, $tahun)
{
    return $this->db->table('membership')
        ->select('COUNT(*) as total_membership, SUM(price) as total_pendapatan')
        ->where('MONTH(start_date)', $bulan)
        ->where('YEAR(start_date)', $tahun)
        ->get()
        ->getRowArray();
}
}
