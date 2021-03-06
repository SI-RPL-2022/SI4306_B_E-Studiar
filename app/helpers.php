<?php

use App\Models\Mentor;
use App\Models\Pembayaran;

function mentorIdExist($id)
{
  return Mentor::where('id', $id)->exists();
}

function generateMentorID()
{
  $number = mt_rand(1000000000, 9999999999);

  if (mentorIdExist($number)) {
    return generateMentorID();
  }

  return $number;
}

function pembayaranIdExist($id)
{
  return Pembayaran::where('id', $id)->exists();
}

function generateNoTransaksi()
{
  $number = mt_rand(1000000000, 9999999999);

  if (pembayaranIdExist($number)) {
    return generateNoTransaksi();
  }
  return $number;
}

$data_sementara_calon_mentor;

function saveCalonMentorData($data)
{
  global $data_sementara_calon_mentor;
  $data_sementara_calon_mentor = $data;
}

function getCalonMentorData()
{
  global $data_sementara_calon_mentor;
  return $data_sementara_calon_mentor;
}

function rupiah($angka)
{
  $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
  return $hasil_rupiah;
}