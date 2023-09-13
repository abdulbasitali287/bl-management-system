<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BillOfLading extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['bid'];
    protected $primaryKey = "bid";
    // protected $table = "bill_of_ladings";
    protected $fillable = ["user_id","shipper_id","aesl_no","idbn_no","bl_no","port_of_loading","port_of_discharge","freight_chr","arrival_date","gross_weight","pkg_count","status"];

    public function setAeslNoAttribute($value){
        $aesl_no = UniqueIdGenerator::generate(['table' => 'bill_of_ladings', 'field' => 'aesl_no','length' => 8, 'suffix' => date('/Y')]);
        $this->attributes['aesl_no'] = $aesl_no;
    }
    public function setIdbnNoAttribute($value){
        $idbn_no = UniqueIdGenerator::generate(['table' => 'bill_of_ladings', 'field' => 'idbn_no','length' => 18,'prefix' => 'IDBN-','suffix' => date('-m/Y')]);
        $this->attributes['idbn_no'] = $idbn_no;
    }

    // public function setUserIdAttribute(){
    //     $this->attributes['user_id'] = auth()->user()->id;
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shipper(){
        return $this->belongsTo(Shipper::class,'shipper_id');
    }

    public function shipping_line(){
        return $this->belongsTo(ShippingLine::class,'vessel_id');
    }

}
