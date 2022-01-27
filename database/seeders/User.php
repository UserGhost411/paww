<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'userghost411',
            'displayname' => 'UserGhost411',
            'email' => 'userghosts411@gmail.com',
            'password' => Hash::make('123'),
            'level' => 3,
        ]);
        DB::table('users')->insert([
            'username' => 'dpm',
            'displayname' => 'Dewan Perwakilan Mahasiswa',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('123'),
            'level' => 2,
        ]);
        DB::table('users')->insert([
            'username' => 'kemahasiswaan',
            'displayname' => 'Kemahasiswaan',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('123'),
            'level' => 2,
        ]);
        DB::table('users')->insert([
            'username' => 'user',
            'displayname' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('123'),
            'level' => 1,
        ]);
        DB::table('document_category')->insert([
            'category_name' => 'UKM',
            'category_description' => 'TEsting Dokumen',
        ]);
        DB::table('document_flow')->insert([
            'docflow_title' => 'Pengumpulan UKM',
            'docflow_description' => 'TEsting Dokumen',
            'docflow_category' => 1,
        ]);
        DB::table('document_flow')->insert([
            'docflow_title' => 'Pengumpulan HMSI',
            'docflow_description' => 'TEsting Dokumen',
            'docflow_category' => 1,
        ]);
        DB::table('document_flow')->insert([
            'docflow_title' => 'Pengumpulan HEHE',
            'docflow_description' => 'TEsting Dokumen',
            'docflow_category' => 1,
        ]);
        DB::table('flows')->insert([
            'flow_title' => 'Check Point DPM',
            'flow_description' => 'TEsting Dokumen',
            'flow_id' => 1,
            'flow_actor' => 2,
            'actor_can_decline' => 1,
            'actor_can_commit' => 1,
        ]);
        DB::table('flows')->insert([
            'flow_title' => 'Check Point Kemahasiswaan',
            'flow_description' => 'TEsting Dokumen',
            'flow_id' => 1,
            'flow_actor' => 3,
            'actor_can_decline' => 1,
            'actor_can_commit' => 1,
        ]);
        DB::table('flows')->insert([
            'flow_title' => 'Check Point DPM2',
            'flow_description' => 'TEsting Dokumen2',
            'flow_id' => 2,
            'flow_actor' => 2,
            'actor_can_decline' => 1,
            'actor_can_commit' => 1,
        ]);
        DB::table('flows')->insert([
            'flow_title' => 'Check Point Kemahasiswaan2',
            'flow_description' => 'TEsting Dokumen2',
            'flow_id' => 2,
            'flow_actor' => 3,
            'actor_can_decline' => 1,
            'actor_can_commit' => 1,
        ]);
        DB::table('flows')->insert([
            'flow_title' => 'Check Point DPM3',
            'flow_description' => 'TEsting Dokumen3',
            'flow_id' => 3,
            'flow_actor' => 2,
            'actor_can_decline' => 1,
            'actor_can_commit' => 1,
        ]);
        DB::table('flows')->insert([
            'flow_title' => 'Check Point Kemahasiswaan3',
            'flow_description' => 'TEsting Dokumen3',
            'flow_id' => 3,
            'flow_actor' => 3,
            'actor_can_decline' => 1,
            'actor_can_commit' => 1,
        ]);
    }
}
