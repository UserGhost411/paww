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
            'level' => 1,
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
        // DB::table('documents')->insert([
        //     'doc_title' => 'RAB UKM Cycology',
        //     'doc_description' => 'TEsting Dokumen',
        //     'flow_step' => 0,
        //     'doc_author' => 1,
        //     'doc_status' => 0,
        //     'doc_flow'=>1,
        // ]);
        // DB::table('documents')->insert([
        //     'doc_title' => 'Proposal Acara Apa gitu',
        //     'doc_description' => 'TEsting Dokumen',
        //     'flow_step' => 1,
        //     'doc_author' => 1,
        //     'doc_status' => 0,
        //     'doc_flow'=>2,
        // ]);
        // DB::table('documents')->insert([
        //     'doc_title' => 'Bikin Minecraft Kampus',
        //     'doc_description' => 'TEsting Dokumen',
        //     'flow_step' => 1,
        //     'doc_author' => 1,
        //     'doc_status' => 2,
        //     'doc_flow'=>1,
        // ]);
        // DB::table('documents')->insert([
        //     'doc_title' => 'Bikin ntahlahasxx',
        //     'doc_description' => 'TEsting Dokumen',
        //     'flow_step' => 2,
        //     'doc_author' => 1,
        //     'doc_status' => 1,
        //     'doc_flow'=>3,
        // ]);
        // DB::table('documents')->insert([
        //     'doc_title' => 'Bikin miawmiaw',
        //     'doc_description' => 'TEsting Dokumen',
        //     'flow_step' => 0,
        //     'doc_author' => 1,
        //     'doc_status' => 2,
        //     'doc_flow'=>1,
        // ]);
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
        // DB::table('files')->insert([
        //     'file_filepath' => 'file.txt',
        //     'file_name' => 'File Nya.txt',
        //     'file_document' => 1,
        //     'file_uploader' => 3,
        //     'file_origin' => 1,
        // ]);
        // DB::table('document_process')->insert([
        //     'process_document' => 1,
        //     'process_actor' => 2,
        //     'process_flows' => 1,
        //     'process_reason' => '',
        //     'process_status' => 2,
        // ]);
        // DB::table('document_process')->insert([
        //     'process_document' => 1,
        //     'process_actor' => 3,
        //     'process_flows' => 2,
        //     'process_reason' => '',
        //     'process_status' => 1,
        // ]);
        // DB::table('document_process')->insert([
        //     'process_document' => 2,
        //     'process_actor' => 2,
        //     'process_flows' => 3,
        //     'process_reason' => '',
        //     'process_status' => 1,
        // ]);

        // DB::table('document_process')->insert([
        //     'process_document' => 3,
        //     'process_actor' => 2,
        //     'process_flows' => 1,
        //     'process_reason' => '',
        //     'process_status' => 1,
        // ]);

        // DB::table('document_logs')->insert([
        //     'log_document' => 1,
        //     'log_actor' => 2,
        //     'log_flows' => 1,
        //     'log_reason' => '',
        //     'log_status' => 0,
        // ]);

        // DB::table('document_logs')->insert([
        //     'log_document' => 1,
        //     'log_actor' => 2,
        //     'log_flows' => 1,
        //     'log_reason' => '',
        //     'log_status' => 1,
        // ]);
        // DB::table('document_logs')->insert([
        //     'log_document' => 1,
        //     'log_actor' => 2,
        //     'log_flows' => 1,
        //     'log_reason' => '',
        //     'log_status' => 2,
        // ]);
        // DB::table('document_logs')->insert([
        //     'log_document' => 3,
        //     'log_actor' => 3,
        //     'log_flows' => 2,
        //     'log_reason' => '',
        //     'log_status' => 0,
        // ]);
        // DB::table('document_logs')->insert([
        //     'log_document' => 3,
        //     'log_actor' => 3,
        //     'log_flows' => 2,
        //     'log_reason' => '',
        //     'log_status' => 1,
        // ]);
        // DB::table('document_logs')->insert([
        //     'log_document' => 2,
        //     'log_actor' => 2,
        //     'log_flows' => 3,
        //     'log_reason' => '',
        //     'log_status' => 0,
        // ]);
        // DB::table('document_logs')->insert([
        //     'log_document' => 2,
        //     'log_actor' => 2,
        //     'log_flows' => 3,
        //     'log_reason' => '',
        //     'log_status' => 1,
        // ]);
    }
}
