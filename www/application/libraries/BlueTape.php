<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BlueTape {

    public function emailToNPM($email, $default = NULL) {
        if (preg_match('/\\d{7}@student\\.unpar\\.ac\\.id/', $email)) {
            return '20' . substr($email, 2, 2) . substr($email, 0, 2) . '0' . substr($email, 4, 3);
        }
        return $default;
    }

    /**
     * Konversi tahun dan bulan ke kode semester
     * @param int $year tahun (20xx)
     * @param int $month bulan (1..12)
     */
    public function yearMonthToSemesterCode($year, $month) {
        if ($month >= 1 && $month <= 5) {
            $semester = 2;
        } else if ($month >= 8 && $month <= 12) {
            $semester = 1;
        } else {
            $semester = 4;
        }
        return substr($year, 2, 2) . $semester;
    }

    /**
     * Konversi kode semester ke string (contoh: "141" menjadi "Padat 2014/2015")
     * @param string $semesterCode kode semester
     * @return representasi string atau FALSE jika gagal
     */
    public function semesterCodeToString($semesterCode) {
        $year = intval('20' . substr($semesterCode, 0, 2));
        switch (substr($semesterCode, 2, 1)) {
            case '1': return 'Ganjil ' . $year . '/' . ($year + 1);
            case '2': return 'Genap ' . ($year - 1) . '/' . $year;
            case '4': return 'Padat ' . ($year - 1). '/' . $year;
        }
        return FALSE;
    }
}
