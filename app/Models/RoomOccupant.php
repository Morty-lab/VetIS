<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomOccupant extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'pet_id',
        'check_in',
        'check_out'
    ];

    protected $table = 'room_occupant';

    public function room()
    {
        return $this->belongsTo(PetLodgeRooms::class, 'room_id');
    }

    public function pet()
    {
        return $this->belongsTo(Pets::class, 'pet_id');
    }

    public static function createRoomOccupant($data)
    {
        $roomOccupant = new RoomOccupant();
        $roomOccupant->room_id = $data['room_id'];
        $roomOccupant->pet_id = $data['pet_id'];
        $roomOccupant->check_in = $data['check_in'];
        $roomOccupant->check_out = $data['check_out'];
        $roomOccupant->save();
        return $roomOccupant;
    }

    public static function updateRoomOccupant($data)
    {
        $roomOccupant = RoomOccupant::find($data['id']);
        $roomOccupant->room_id = $data['room_id'];
        $roomOccupant->pet_id = $data['pet_id'];
        $roomOccupant->check_in = $data['check_in'];
        $roomOccupant->check_out = $data['check_out'];
        $roomOccupant->save();
        return $roomOccupant;
    }

    public static function deleteRoomOccupant($id)
    {
        $roomOccupant = RoomOccupant::find($id);
        $roomOccupant->delete();
        return true;
    }
}








