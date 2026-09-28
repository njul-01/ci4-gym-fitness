<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{ 
    protected $table            = 'members';
    protected $primaryKey       = 'member_id';
    protected $useAutoIncrement = true;
    //protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'member_code',
        'name',
        'phone',
        'email',
        'join_date',
        'status'

    ];
    protected $useTimestamps = true;

       public function search($perPage, $group, $keyword = null) //Menampilkan data member dengan pagination
    {
        $builder = $this->select('members.*')
        ->orderBy('status', 'ASC');
       
        if(!empty($keyword)) {
            $builder= $builder->groupStart()
            ->like('member_code', $keyword)
            ->orLike('name', $keyword)
            ->orLike('phone', $keyword)
            ->orLike('email', $keyword)
            ->orLike('join_date', $keyword)
            ->orLike('status', $keyword)
            ->groupEnd();
        }

        return $builder->paginate($perPage, $group);
    } 

   public function getActiveMembers()
{
    return $this->db->table('members m')
        ->select('m.*')
        ->join('membership ms', 'ms.member_id = m.member_id', 'left')
        ->where('m.status', 'Active') // status MEMBER
        ->groupStart()
            ->where('ms.status IS NULL')      // belum pernah membership
            ->orWhere('ms.status', 'Expired') // membership expired
        ->groupEnd()
        ->groupBy('m.member_id')
        ->orderBy('m.name', 'ASC')
        ->get()
        ->getResultArray();
}
  

   public function getMemberActiveAndMembershipExpired()
{
    return $this->db->table('members m')
        ->select('
            m.member_id,
            m.name,
            MAX(ms.status) AS membership_status
        ')
        ->join(
            'membership ms',
            'ms.member_id = m.member_id',
            'left'
        )
        ->where('m.status', 'Active') // hanya member aktif
        ->where('ms.membership_id IS NULL') // TIDAK punya membership aktif / terjadwal
        ->orderBy('m.name', 'ASC');
}



public function getMembersForNewMembership()
{
    return $this->db->table('members m')
        ->select('m.member_id, m.name')
        ->join('membership ms', 'ms.member_id = m.member_id AND ms.status IN ("Active","Inactive")', 'left')
        ->where('m.status', 'Active')
        ->where('ms.member_id IS NULL') // 🔑 tidak punya membership hidup
        ->orderBy('m.name', 'ASC')
        ->get()
        ->getResultArray();
}

public function getMembersForBooking()
{
    return $this->db->table('members m')
        ->select('m.member_id, m.name')
        ->join('membership ms', 'ms.member_id = m.member_id')
        ->where('m.status', 'Active')
        ->where('ms.status', 'Active')
        ->groupBy('m.member_id')
        ->orderBy('m.name', 'ASC')
        ->get()
        ->getResultArray();
}

  


}
