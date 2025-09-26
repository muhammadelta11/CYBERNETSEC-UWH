<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'front\WelcomeController@index')->name('welcome');
Route::get('/about', 'front\WelcomeController@about')->name('about');
Route::get('/kelas', 'front\KelasController@index')->name('kelas');
Route::get('/upskill', 'front\KelasController@upskill')->name('upskill');
Route::get('/kelas/detail/{id}', 'front\KelasController@detail')->name('kelas.detail');
    Route::get('/kelas/belajar/{id}/{idmateri}', 'front\KelasController@belajar')->name('kelas.belajar');
    Route::post('/kelas/mark-completed', 'front\KelasController@markCompleted')->name('kelas.markCompleted');
    Route::get('/materi/{id}/download', 'front\KelasController@downloadMateri')->name('materi.download');
Route::get('/podcast', 'front\PodcastController@index')->name('podcast');
Route::get('/podcast/detail/{id}', 'front\PodcastController@detail')->name('podcast.detail');
Route::get('/blog', 'front\BlogController@index')->name('blog');
Route::get('/blog/detail/{id}', 'front\BlogController@detail')->name('blog.detail');

// User Approval Routes
Route::get('/pending-approval', function () {
    return view('auth.pending-approval');
})->name('pending-approval');

// Registration Routes
Route::get('/register/umum', 'Auth\RegisterController@showUmumRegistrationForm')->name('register.umum');
Route::post('/register/umum', 'Auth\RegisterController@registerUmum')->name('register.umum.submit');

Route::group(['middleware' => ['auth', 'checkRole:users_all']], function () {
    Route::get('/upgradepremium', 'front\TransaksiController@index')->name('upgradepremium');
    Route::post('/uploadbukti', 'front\TransaksiController@uploadbukti')->name('uploadbukti');
    Route::post('/uploadulang', 'front\TransaksiController@uploadulang')->name('uploadulang');
    Route::post('/kirimnotifikasi', 'front\TransaksiController@kirimNotifikasi')->name('kirimnotifikasi');

    Route::get('/transaksi/kelas/{id}', 'front\TransaksiController@bayarKelas')->name('transaksi.kelas');
    Route::get('/transaksi/kelas/daftar/{id}', 'front\TransaksiController@daftarKelas')->name('transaksi.kelas.daftar');
    Route::post('/transaksi/kelas/uploadbukti/{id}', 'front\TransaksiController@uploadBuktiKelas')->name('transaksi.kelas.uploadbukti');
    Route::post('/transaksi/kelas/kirim/{id}', 'front\TransaksiController@kirimTanpaBukti')->name('transaksi.kelas.kirim');

    Route::get('/akun', 'front\AkunController@index')->name('akun');
    Route::get('/akun/editprofil', 'front\AkunController@editprofil')->name('akun.editprofil');
    Route::post('/akun/simpaneditprofil', 'front\AkunController@simpaneditprofil')->name('akun.simpaneditprofil');
    Route::get('/akun/editkatasandi', 'front\AkunController@editkatasandi')->name('akun.editkatasandi');
    Route::post('/akun/simpaneditkatasandi', 'front\AkunController@simpaneditkatasandi')->name('akun.simpaneditkatasandi');

    // Route::get('/dashboard', 'front\DashboardController@index')->name('dashboard');
    Route::get('/kursus-diambil', 'front\KursusController@diambil')->name('kursus.diambil');
    // Route::get('/daftar-kursus', 'front\KursusController@daftar')->name('kursus.daftar');
    // Route::post('/daftar-kursus/enroll/{id}', 'front\KursusController@enroll')->name('kursus.enroll');
    Route::get('/e-sertifikat', 'front\SertifikatController@index')->name('sertifikat.index');
    Route::get('/e-sertifikat/download/{id}', 'front\SertifikatController@download')->middleware('signed')->name('front.sertifikat.download');

    Route::post('/podcast/register/{id}', 'front\PodcastController@register')->name('podcast.register');

    // Event Registrations Management
    Route::get('/event-registrations', 'front\EventRegistrationController@index')->name('event-registrations.index');
    Route::get('/event-registrations/{id}', 'front\EventRegistrationController@show')->name('event-registrations.show');
    Route::post('/event-registrations/{id}/upload-proof', 'front\EventRegistrationController@uploadPaymentProof')->name('event-registrations.upload-proof');
});

Route::group(['middleware' => ['auth', 'checkRole:admin_all']], function () {

    Route::get('/admin', 'admin\DashboardController@index')->name('admin');

    // Routes accessible by all admin roles
    Route::get('/admin/editprofil', 'admin\UserController@editprofil')->name('admin.editprofil');
    Route::post('/admin/simpaneditprofil', 'admin\UserController@simpaneditprofil')->name('admin.simpaneditprofil');
    Route::get('/admin/editkatasandi', 'admin\UserController@editkatasandi')->name('admin.editkatasandi');
    Route::post('/admin/simpaneditkatasandi', 'admin\UserController@simpaneditkatasandi')->name('admin.simpaneditkatasandi');

    // Routes for Administrator and Admin Upskill
    Route::group(['middleware' => ['checkRole:admin,admin_upskill']], function () {
        //User Management
        Route::get('/admin/user', 'admin\UserController@index')->name('admin.user');
        Route::get('/admin/user/export', 'admin\UserController@export')->name('admin.user.export');
        Route::get('/admin/user/detail/{id}', 'admin\UserController@detail')->name('admin.user.detail');
        Route::get('/admin/user/edit/{id}', 'admin\UserController@edit')->name('admin.user.edit');
        Route::post('/admin/user/update/{id}', 'admin\UserController@update')->name('admin.user.update');
        Route::get('/admin/user/delete/{id}', 'admin\UserController@destroy')->name('admin.user.delete');
        Route::get('/admin/user/approve/{id}', 'admin\UserController@approve')->name('admin.user.approve');
        Route::get('/admin/user/reject/{id}', 'admin\UserController@reject')->name('admin.user.reject');
        Route::get('/admin/user/deactivate/{id}', 'admin\UserController@deactivate')->name('admin.user.deactivate');

        // Import System
        Route::get('/admin/import', 'admin\ImportController@index')->name('admin.import');
        Route::get('/admin/import/form', 'admin\ImportController@showImportForm')->name('admin.import.form');
        Route::post('/admin/import/mahasiswa', 'admin\ImportController@importMahasiswa')->name('admin.import.mahasiswa');
        Route::get('/admin/import/template', 'admin\ImportController@downloadTemplate')->name('admin.import.template');
        Route::post('/admin/import/bulk-delete', 'admin\ImportController@bulkDelete')->name('admin.import.bulk-delete');

        // Rekening Routes
        Route::get('/admin/rekening', 'admin\RekeningController@index')->name('admin.rekening');
        Route::get('/admin/rekening/create', 'admin\RekeningController@create')->name('admin.rekening.create');
        Route::post('/admin/rekening/store', 'admin\RekeningController@store')->name('admin.rekening.store');
        Route::get('/admin/rekening/edit/{id}', 'admin\RekeningController@edit')->name('admin.rekening.edit');
        Route::put('/admin/rekening/update/{id}', 'admin\RekeningController@update')->name('admin.rekening.update');
        Route::delete('/admin/rekening/destroy/{id}', 'admin\RekeningController@destroy')->name('admin.rekening.destroy');

        // User Log
        Route::get('/admin/userlog', 'admin\UserLogController@index')->name('admin.userlog');
        Route::get('/admin/userlog/export', 'admin\UserLogController@export')->name('admin.userlog.export');
        Route::get('/admin/userlog/detail/{id}', 'admin\UserLogController@detail')->name('admin.userlog.detail');
        Route::get('/admin/userlog/edit/{id}', 'admin\UserLogController@edit')->name('admin.userlog.edit');
        Route::post('/admin/userlog/update/{id}', 'admin\UserLogController@update')->name('admin.userlog.update');
        Route::get('/admin/userlog/delete/{id}', 'admin\UserLogController@destroy')->name('admin.userlog.delete');
        Route::get('/admin/userlog/approve/{id}', 'admin\UserLogController@approve')->name('admin.userlog.approve');
        Route::get('/admin/userlog/reject/{id}', 'admin\UserLogController@reject')->name('admin.userlog.reject');
        Route::get('/admin/userlog/deactivate/{id}', 'admin\UserLogController@deactivate')->name('admin.userlog.deactivate');
    });

    // Routes for Administrator only
    Route::group(['middleware' => ['checkRole:admin']], function () {
        // System Settings
        Route::get('/admin/setting', 'admin\SettingController@index')->name('admin.setting');
        Route::post('/admin/setting/simpan', 'admin\SettingController@simpan')->name('admin.setting.simpan');

        // Email Test Route
        Route::get('/admin/test-email', function () {
            return view('admin.test-email', ['title' => 'Test Email Configuration']);
        })->name('admin.test-email');

        Route::post('/admin/test-email/send', function (Illuminate\Http\Request $request) {
            try {
                $email = $request->input('email', 'test@example.com');
                $testUser = new App\User([
                    'name' => 'Test User',
                    'email' => $email
                ]);
                $testUser->notify(new App\Notifications\UserRejectedNotification());
                return redirect()->back()->with('success', 'Email test berhasil dikirim ke: ' . $email);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
            }
        })->name('admin.test-email.send');
    });

    // Routes for Administrator and Admin Upskill
    Route::group(['middleware' => ['checkRole:admin,admin_upskill']], function () {
        //Kelas Management
        Route::get('/admin/kelas', 'admin\KelasController@index')->name('admin.kelas');
        Route::get('/admin/kelas/tambah', 'admin\KelasController@tambah')->name('admin.kelas.tambah');
        Route::post('/admin/kelas/simpan', 'admin\KelasController@simpan')->name('admin.kelas.simpan');
        Route::get('/admin/kelas/detail/{id}', 'admin\KelasController@detail')->name('admin.kelas.detail');
        Route::get('/admin/kelas/hapus/{id}', 'admin\KelasController@hapus')->name('admin.kelas.hapus');
        Route::get('/admin/kelas/edit/{id}', 'admin\KelasController@edit')->name('admin.kelas.edit');
        Route::post('/admin/kelas/update/{id}', 'admin\KelasController@update')->name('admin.kelas.update');
        Route::get('/admin/kelas/tambahvideo/{id}', 'admin\KelasController@tambahvideo')->name('admin.kelas.tambahvideo');
        Route::post('/admin/kelas/simpanvideo/{id}', 'admin\KelasController@simpanvideo')->name('admin.kelas.simpanvideo');
        Route::get('/admin/kelas/hapusvideo/{id}/{idkelas}', 'admin\KelasController@hapusvideo')->name('admin.kelas.hapusvideo');
        Route::post('/admin/upload', 'admin\KelasController@upload')->name('admin.upload');

        // Semester Management
        Route::get('/admin/semesters', 'admin\SemesterController@index')->name('admin.semesters');
        Route::get('/admin/semesters/tambah', 'admin\SemesterController@tambah')->name('admin.semesters.tambah');
        Route::post('/admin/semesters/simpan', 'admin\SemesterController@simpan')->name('admin.semesters.simpan');
        Route::get('/admin/semesters/detail/{id}', 'admin\SemesterController@detail')->name('admin.semesters.detail');
        Route::get('/admin/semesters/hapus/{id}', 'admin\SemesterController@hapus')->name('admin.semesters.hapus');
        Route::get('/admin/semesters/edit/{id}', 'admin\SemesterController@edit')->name('admin.semesters.edit');
        Route::put('/admin/semesters/update/{id}', 'admin\SemesterController@update')->name('admin.semesters.update');

        // Upskill Categories Management
        Route::get('/admin/upskill_categories', 'admin\UpskillCategoryController@index')->name('admin.upskill_categories');
        Route::get('/admin/upskill_categories/tambah', 'admin\UpskillCategoryController@tambah')->name('admin.upskill_categories.tambah');
        Route::post('/admin/upskill_categories/simpan', 'admin\UpskillCategoryController@simpan')->name('admin.upskill_categories.simpan');
        Route::get('/admin/upskill_categories/detail/{id}', 'admin\UpskillCategoryController@detail')->name('admin.upskill_categories.detail');
        Route::get('/admin/upskill_categories/hapus/{id}', 'admin\UpskillCategoryController@hapus')->name('admin.upskill_categories.hapus');
        Route::get('/admin/upskill_categories/edit/{id}', 'admin\UpskillCategoryController@edit')->name('admin.upskill_categories.edit');
        Route::put('/admin/upskill_categories/update/{id}', 'admin\UpskillCategoryController@update')->name('admin.upskill_categories.update');

        // Sertifikat
        Route::get('/admin/sertifikat', 'admin\SertifikatController@index')->name('admin.sertifikat');
        Route::get('/admin/sertifikat/create', 'admin\SertifikatController@create')->name('admin.sertifikat.create');
        Route::post('/admin/sertifikat/store', 'admin\SertifikatController@store')->name('admin.sertifikat.store');
    });

    // Routes for Administrator, Admin Upskill, and Operator
    Route::group(['middleware' => ['checkRole:admin,admin_upskill,operator']], function () {
        //Transaksi Management
        Route::get('/admin/transaksi', 'admin\TransaksiController@index')->name('admin.transaksi');
        Route::get('/admin/transaksi/belumdicek', 'admin\TransaksiController@belumdicek')->name('admin.transaksi.belumdicek');
        Route::get('/admin/transaksi/ditolak', 'admin\TransaksiController@ditolak')->name('admin.transaksi.ditolak');
        Route::get('/admin/transaksi/disetujui', 'admin\TransaksiController@disetujui')->name('admin.transaksi.disetujui');
        Route::get('/admin/transaksi/detail/{id}', 'admin\TransaksiController@detail')->name('admin.transaksi.detail');
        Route::post('/admin/transaksi/ubah/{id}', 'admin\TransaksiController@ubah')->name('admin.transaksi.ubah');
    });

    // Routes for Administrator and Operator
    Route::group(['middleware' => ['checkRole:admin,operator']], function () {
        // Event Registrations
        Route::get('/admin/event-registrations', 'admin\EventRegistrationController@index')->name('admin.event-registrations.index');
        Route::get('/admin/event-registrations/{id}', 'admin\EventRegistrationController@show')->name('admin.event-registrations.show');
        Route::post('/admin/event-registrations/{id}/status', 'admin\EventRegistrationController@updateStatus')->name('admin.event-registrations.update-status');
        Route::post('/admin/event-registrations/{id}/upload-proof', 'admin\EventRegistrationController@uploadPaymentProof')->name('admin.event-registrations.upload-proof');
        Route::post('/admin/event-registrations/{id}/confirm-payment', 'admin\EventRegistrationController@confirmPayment')->name('admin.event-registrations.confirm-payment');
        Route::post('/admin/event-registrations/{id}/reject-payment', 'admin\EventRegistrationController@rejectPayment')->name('admin.event-registrations.reject-payment');
    });

    // Routes accessible by all admin roles

    // Podcast Management
    Route::get('/admin/podcast', 'admin\PodcastController@index')->name('admin.podcast');
    Route::get('/admin/podcast/tambah', 'admin\PodcastController@tambah')->name('admin.podcast.tambah');
    Route::post('/admin/podcast/simpan', 'admin\PodcastController@simpan')->name('admin.podcast.simpan');
    Route::get('/admin/podcast/detail/{id}', 'admin\PodcastController@detail')->name('admin.podcast.detail');
    Route::get('/admin/podcast/hapus/{id}', 'admin\PodcastController@hapus')->name('admin.podcast.hapus');
    Route::get('/admin/podcast/edit/{id}', 'admin\PodcastController@edit')->name('admin.podcast.edit');
    Route::post('/admin/podcast/update/{id}', 'admin\PodcastController@update')->name('admin.podcast.update');

    //Blog Management
    Route::get('/admin/blog', 'admin\BlogController@index')->name('admin.blog');
    Route::get('/admin/blog/tambah', 'admin\BlogController@tambah')->name('admin.blog.tambah');
    Route::post('/admin/blog/simpan', 'admin\BlogController@simpan')->name('admin.blog.simpan');
    Route::get('/admin/blog/hapus/{id}', 'admin\BlogController@hapus')->name('admin.blog.hapus');
    Route::get('/admin/blog/detail/{id}', 'admin\BlogController@detail')->name('admin.blog.detail');
    Route::get('/admin/blog/edit/{id}', 'admin\BlogController@edit')->name('admin.blog.edit');
    Route::post('/admin/blog/update/{id}', 'admin\BlogController@update')->name('admin.blog.update');

    //Blog Categories
    Route::get('/admin/blog-categories', 'admin\BlogCategoryController@index')->name('admin.blog_categories');
    Route::get('/admin/blog-categories/tambah', 'admin\BlogCategoryController@tambah')->name('admin.blog_categories.tambah');
    Route::post('/admin/blog-categories/simpan', 'admin\BlogCategoryController@simpan')->name('admin.blog_categories.simpan');
    Route::get('/admin/blog-categories/edit/{id}', 'admin\BlogCategoryController@edit')->name('admin.blog_categories.edit');
    Route::post('/admin/blog-categories/update/{id}', 'admin\BlogCategoryController@update')->name('admin.blog_categories.update');
    Route::delete('/admin/blog-categories/hapus/{id}', 'admin\BlogCategoryController@hapus')->name('admin.blog_categories.hapus');
});

Auth::routes();
