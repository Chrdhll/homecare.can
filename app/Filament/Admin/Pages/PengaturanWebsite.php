<?php

namespace App\Filament\Admin\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;

class PengaturanWebsite extends Page
{
    // === Pengaturan Menu ===
    protected static ?string $navigationIcon = 'heroicon-o-document-text'; // Ikon teks
    protected static ?string $navigationLabel = 'Konten Website';
    protected static ?string $navigationGroup = 'Pengaturan'; // Masuk grup Pengaturan
    protected static ?int $navigationSort = 1; // Urutan pertama di grup

    protected static string $view = 'filament.admin.pages.pengaturan-website';

    public ?array $data = [];

    // Daftar key CMS yang akan kita kelola di halaman INI
    protected function getSettingKeys(): array
    {
        return [
            // Hero
            'hero_title', 'hero_subtitle',
            'hero_indicator1_title', 'hero_indicator1_subtitle',
            'hero_indicator2_title', 'hero_indicator2_subtitle',
            'hero_indicator3_title', 'hero_indicator3_subtitle',
            // CTA (Galeri)
            'cta_title', 'cta_text',
            // About Us
            'about_subtitle', 'about_title', 'about_text',
            'about_point1_title', 'about_point1_text',
            'about_point2_title', 'about_point2_text',
            'about_point3_title', 'about_point3_text',
            'about_image',
            // Why Us
            'whyus_subtitle', 'whyus_title',
            'faq1_q', 'faq1_a', // FAQ 1 (Paragraf)
            'faq2_q', 'faq2_a', // FAQ 2 (List)
            'faq3_q', 'faq3_a', // FAQ 3 (List)
            'whyus_image',
            // Services
            'services_title', 'services_subtitle',
            // Contact
            'contact_title', 'contact_subtitle',
            'contact_address_label', 'contact_address',
            'contact_phone_label', 'contact_phone',
            'contact_email_label', 'contact_email',
            'gmaps_link',
            'footer_social_text',
            'footer_link_twitter',
            'footer_link_facebook',
            'footer_link_instagram',
            'footer_link_linkedin',
            // Ongkir (dari file lama)
            'admin_latitude', 'admin_longitude',
            'transport_price_per_km',
            'max_distance_km',
            // BARU: Box Konsultasi (Footer)
            'consultation_title', 'consultation_text', 'consultation_btn_text',
        ];
    }

    public function mount(): void
    {
        $settings = DB::table('settings')
                        ->whereIn('key', $this->getSettingKeys())
                        ->pluck('value', 'key')
                        ->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Pengaturan Konten Website')
                    ->tabs([
                        // ===================================
                        // TAB 1: HALAMAN UTAMA
                        // ===================================
                        Tabs\Tab::make('Halaman Utama')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Section::make('Hero Section')
                                    ->description('Teks utama di bagian paling atas website.')
                                    ->schema([
                                        TextInput::make('hero_title')->label('Judul Hero'),
                                        Textarea::make('hero_subtitle')->label('Sub-Judul Hero (Paragraf)')->rows(3),
                                    ])->collapsible(),

                                Section::make('Trust Indicators (Di bawah Search Bar)')
                                    ->schema([
                                        TextInput::make('hero_indicator1_title')->label('Indikator 1: Judul (e.g. Certified)'),
                                        TextInput::make('hero_indicator1_subtitle')->label('Indikator 1: Sub-Judul (e.g. Health Professional)'),
                                        TextInput::make('hero_indicator2_title')->label('Indikator 2: Judul (e.g. Personalized)'),
                                        TextInput::make('hero_indicator2_subtitle')->label('Indikator 2: Sub-Judul (e.g. Treatment)'),
                                        TextInput::make('hero_indicator3_title')->label('Indikator 3: Judul (e.g. Fast & Safe)'),
                                        TextInput::make('hero_indicator3_subtitle')->label('Indikator 3: Sub-Judul (e.g. Home Service)'),
                                    ])->collapsible(),

                                Section::make('Call to Action (Slider Galeri)')
                                    ->description('Teks di samping slider galeri.')
                                    ->schema([
                                        TextInput::make('cta_title')->label('Judul (e.g. Layanan Profesional Kami)'),
                                        Textarea::make('cta_text')->label('Paragraf Teks')->rows(3),
                                    ])->collapsible(),

                                Section::make('Section Layanan Kami')
                                    ->description('Judul di atas kartu-kartu layanan.')
                                    ->schema([
                                        TextInput::make('services_title')->label('Judul (e.g. Layanan Kami)'),
                                        Textarea::make('services_subtitle')->label('Sub-Judul (Paragraf)')->rows(2),
                                    ])->collapsible(),

                                Section::make('Box Konsultasi (Footer)')
                                    ->description('Kotak ajakan konsultasi yang muncul di atas footer.')
                                    ->schema([
                                        TextInput::make('consultation_title')
                                            ->label('Judul (e.g. Bingung Pilih Layanan?)'),
                                        Textarea::make('consultation_text')
                                            ->label('Teks Deskripsi')
                                            ->rows(2),
                                        TextInput::make('consultation_btn_text')
                                            ->label('Teks Tombol (e.g. Konsultasi Gratis Sekarang)')
                                            ->default('Konsultasi Gratis Sekarang'),
                                    ])->collapsible(),
                            ]),

                        // ===================================
                        // TAB 2: TENTANG & FAQ
                        // ===================================
                        Tabs\Tab::make('Tentang & FAQ')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                Section::make('Tentang Kami')
                                    ->schema([
                                        TextInput::make('about_subtitle')->label('Sub-Judul (e.g. Tentang Kami)'),
                                        TextInput::make('about_title')->label('Judul (e.g. Layanan Kesehatan Personal...)'),
                                        Textarea::make('about_text')->label('Paragraf Teks (Italic)')->rows(5),
                                    ])->collapsible(),

                                Section::make('Poin Keunggulan "Tentang Kami"')
                                    ->schema([
                                        TextInput::make('about_point1_title')->label('Poin 1: Judul'),
                                        TextInput::make('about_point1_text')->label('Poin 1: Teks'),
                                        TextInput::make('about_point2_title')->label('Poin 2: Judul'),
                                        TextInput::make('about_point2_text')->label('Poin 2: Teks'),
                                        TextInput::make('about_point3_title')->label('Poin 3: Judul (Opsional)'),
                                        TextInput::make('about_point3_text')->label('Poin 3: Teks (Opsional)'),
                                    ])->collapsible(),

                                Section::make('Gambar "Tentang Kami"')
                                    ->schema([
                                        FileUpload::make('about_image')
                                            ->label('Upload Gambar "Tentang Kami"')
                                            ->image()
                                            ->directory('cms-images')
                                            ->helperText('Rekomendasi rasio 1:1 (persegi) atau 4:3.')
                                    ])->collapsible(),

                                Section::make('Kenapa Kami (Why Us / FAQ)')
                                    ->schema([
                                        TextInput::make('whyus_subtitle')->label('Sub-Judul (e.g. Kenapa Homecare.can?)'),
                                        TextInput::make('whyus_title')->label('Judul Utama (e.g. Semua Tentang Immune Booster)'),

                                        // FAQ 1 (Paragraf)
                                        TextInput::make('faq1_q')->label('FAQ 1: Pertanyaan'),
                                        Textarea::make('faq1_a')->label('FAQ 1: Jawaban (Paragraf)')->rows(3),

                                        // FAQ 2 (List)
                                        TextInput::make('faq2_q')->label('FAQ 2: Pertanyaan'),
                                        Textarea::make('faq2_a')->label('FAQ 2: Jawaban (List)')
                                            ->rows(4)
                                            ->helperText('Tulis satu poin per baris (tekan Enter).'),

                                        // FAQ 3 (List)
                                        TextInput::make('faq3_q')->label('FAQ 3: Pertanyaan'),
                                        Textarea::make('faq3_a')->label('FAQ 3: Jawaban (List)')
                                            ->rows(4)
                                            ->helperText('Tulis satu poin per baris (tekan Enter).'),
                                    ])->collapsible(),

                                    Section::make('Gambar "Why Us"')
                                    ->schema([
                                        FileUpload::make('whyus_image')
                                            ->label('Upload Gambar "Why Us"')
                                            ->image()
                                            ->directory('cms-images')
                                            ->helperText('Rekomendasi rasio 1:1 (persegi) atau 4:3.')
                                    ])->collapsible(),
                            ]),

                        // ===================================
                        // TAB 3: KONTAK & LOKASI
                        // ===================================
                        Tabs\Tab::make('Kontak, Footer, Lokasi & ongkir')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                Section::make('Nomor Pusat (Penerima Pesanan)')
                                    ->description('Nomor ini sangat vital! Semua pesanan pasien akan diarahkan ke nomor ini.')
                                    ->icon('heroicon-m-device-phone-mobile')
                                    ->schema([
                                        TextInput::make('contact_phone')
                                            ->label('Nomor WhatsApp Admin')
                                            ->prefixIcon('heroicon-m-chat-bubble-left-right')
                                            ->placeholder('Contoh: 6282287339437')
                                            ->helperText('Gunakan format internasional (62...) atau lokal (08...). Sistem akan otomatis menyesuaikannya untuk link WA.')
                                            ->required()
                                            ->columnSpanFull(), // Lebar penuh biar fokus

                                        TextInput::make('contact_phone_label')
                                            ->label('Label Tombol/Teks (e.g. WhatsApp Kami)')
                                            ->default('WhatsApp')
                                            ->columnSpanFull(),
                                    ])
                                    ->collapsible(),

                                Section::make('Info Footer lainnya')
                                    ->schema([
                                        TextInput::make('contact_title')->label('Judul Section (e.g. Kontak Kami)'),
                                        Textarea::make('contact_subtitle')->label('Sub-Judul Section (Paragraf)')->rows(2),
                                        TextInput::make('contact_address_label')->label('Label Alamat (e.g. Lokasi Kami)'),
                                        TextInput::make('contact_address')->label('Isi Alamat'),
                                        TextInput::make('contact_email_label')->label('Label Email (e.g. Email Kami)'),
                                        TextInput::make('contact_email')->label('Isi Email'),
                                        Textarea::make('gmaps_link')->label('Link Google Maps (full iframe code)')->rows(4),
                                    ])->collapsible(),

                                Section::make('Media Sosial')
                                    ->description('Teks dan link sosial media di bagian footer.')
                                    ->schema([
                                        Textarea::make('footer_social_text')
                                            ->label('Teks "Ikuti Kami" di Footer')
                                            ->rows(3),
                                        TextInput::make('footer_link_twitter')->label('Link Twitter / X'),
                                        TextInput::make('footer_link_facebook')->label('Link Facebook'),
                                        TextInput::make('footer_link_instagram')->label('Link Instagram'),
                                        TextInput::make('footer_link_linkedin')->label('Link LinkedIn'),
                                    ])->collapsible(),

                                 Section::make('Pengaturan Ongkos Kirim (Ongkir)')
                                        ->description('Tentukan titik awal dan tarif ongkir.')
                                        ->icon('heroicon-m-truck')
                                        ->schema([
                                            Group::make()
                                                ->schema([
                                                    TextInput::make('admin_latitude')
                                                        ->label('Latitude Titik Asal')
                                                        ->numeric()
                                                        ->required(),
                                                    TextInput::make('admin_longitude')
                                                        ->label('Longitude Titik Asal')
                                                        ->numeric()
                                                        ->required(),
                                                ])->columns(2),

                                            TextInput::make('transport_price_per_km')
                                                ->label('Tarif Ongkir per KM')
                                                ->numeric()
                                                ->prefix('Rp')
                                                ->suffix('/ km')
                                                ->default(2000) // Contoh default
                                                ->required()
                                                ->helperText('Biaya yang dikenakan setiap 1 kilometer jarak ke pasien.'),

                                            TextInput::make('max_distance_km')
                                                ->label('Maksimal Jarak Layanan')
                                                ->numeric()
                                                ->suffix('km')
                                                ->default(20) // Default 20km
                                                ->required()
                                                ->helperText('Jika jarak pasien melebihi angka ini, pesanan akan ditolak otomatis.')
                                                ->hintIcon('heroicon-m-no-symbol'),
                                        ])->collapsible(),
                                                                ]),
                                                        ])
                                                        ->columnSpanFull(),
                                                ])
                                                ->statePath('data');
    }

    /**
     * Aksi saat tombol "Simpan" ditekan.
     */
    public function save(): void
    {
        try {
            $validatedData = $this->form->getState();
            foreach ($validatedData as $key => $value) {
                if (in_array($key, $this->getSettingKeys())) {
                    DB::table('settings')->updateOrInsert(
                        ['key' => $key],
                        ['value' => $value, 'updated_at' => now()]
                    );
                }
            }

            cache()->forget('all_settings');

        } catch (\Exception $e) {
            Notification::make()->title('Gagal menyimpan!')->body($e->getMessage())->danger()->send();
            return;
        }

        Notification::make()->title('Konten Website berhasil disimpan')->success()->send();
    }
}
