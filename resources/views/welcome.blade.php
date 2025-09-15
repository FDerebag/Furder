<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Furder Yazılım ve Teknoloji Hizmetleri | Kurumsal Yazılım Çözümleri</title>
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900" rel="stylesheet" />
        <!-- Vite yerine direkt CSS kullanıyoruz -->
        <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        @keyframes pulse-glow { 
            0%, 100% { 
                box-shadow: 0 0 20px rgba(0, 212, 255, 0.4), 0 0 40px rgba(255, 107, 53, 0.2); 
            } 
            50% { 
                box-shadow: 0 0 40px rgba(0, 212, 255, 0.8), 0 0 80px rgba(255, 107, 53, 0.4), 0 0 120px rgba(247, 147, 30, 0.2); 
            } 
        }
        @keyframes gradient-shift { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        @keyframes text-shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
        
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
        .animate-gradient { animation: gradient-shift 3s ease infinite; }
        .animate-text-shimmer { animation: text-shimmer 2s linear infinite; }
        
        .bg-gradient-animated {
            background: linear-gradient(-45deg, #0f0f23, #1a1a2e, #16213e, #0f3460, #533a7b, #4a148c);
            background-size: 400% 400%;
        }
        
        .text-gradient {
            background: linear-gradient(45deg, #00d4ff, #ff6b35, #f7931e, #ffdd00, #7b68ee, #00bcd4);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .glass-effect {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        
        .glow-border {
            position: relative;
            overflow: hidden;
        }
        
        .glow-border::before {
            content: '';
            position: absolute;
            inset: 0;
            padding: 2px;
            background: linear-gradient(45deg, #00d4ff, #ff6b35, #f7931e, #ffdd00, #7b68ee);
            border-radius: inherit;
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
            animation: gradient-shift 3s ease infinite;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-animated animate-gradient text-white overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass-effect transition-all duration-300 h-28">
        <div class="max-w-7xl mx-auto px-6 h-full">
            <div class="flex items-center justify-between h-full">
                <div class="flex items-center">
                    <img src="{{ asset('images/furderlogobeyaz.png') }}" alt="Furder Logo" class="h-20 md:h-24 w-auto object-contain transition-all duration-300 hover:scale-105 cursor-pointer" />
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="hover:text-cyan-300 transition-colors duration-300">Ana Sayfa</a>
                    <a href="#about" class="hover:text-orange-300 transition-colors duration-300">Hakkımızda</a>
                    <a href="#projects" class="hover:text-yellow-300 transition-colors duration-300">Referanslar</a>
                    <a href="#skills" class="hover:text-purple-300 transition-colors duration-300">Hizmetler</a>
                    <a href="#contact" class="hover:text-cyan-300 transition-colors duration-300">İletişim</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center relative pt-20">
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-cyan-400/10 rounded-full blur-3xl animate-float"></div>
            <div class="absolute top-3/4 right-1/4 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl animate-float" style="animation-delay: -2s;"></div>
            <div class="absolute top-1/2 left-3/4 w-80 h-80 bg-yellow-400/10 rounded-full blur-3xl animate-float" style="animation-delay: -4s;"></div>
            <div class="absolute top-1/3 right-1/3 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl animate-float" style="animation-delay: -6s;"></div>
        </div>
        
        <div class="text-center z-10 max-w-6xl mx-auto px-6">
            <h1 class="text-5xl md:text-7xl font-black mb-6 text-gradient leading-tight">
                KURUMSAL YAZILIM<br>
                VE TEKNOLOJİ HİZMETLERİ
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Ölçeklenebilir, güvenli ve performans odaklı çözümler ile kurumların dijital dönüşümüne güç katıyoruz.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <button class="glow-border glass-effect px-8 py-4 rounded-full text-lg font-semibold hover:scale-105 transition-all duration-300 animate-pulse-glow">
                    🚀 Hizmetlerimizi Keşfedin
                </button>
                <button onclick="openQuoteModal()" class="glass-effect px-8 py-4 rounded-full text-lg font-semibold hover:scale-105 transition-all duration-300 border border-white/30">
                    💼 Teklif Alın
                </button>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-5xl md:text-6xl font-bold mb-6 text-gradient">
                    Hakkımızda
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="glass-effect p-8 rounded-3xl hover:scale-105 transition-all duration-500">
                    <h3 class="text-3xl font-bold mb-6 text-gradient">Furder Yazılım ve Teknoloji Hizmetleri</h3>
                    <p class="text-lg mb-6 text-gray-200 leading-relaxed">
                        Kamu ve özel sektöre; web, mobil, bulut ve entegrasyon projelerinde uçtan uca yazılım geliştirme, danışmanlık ve bakım hizmetleri sunuyoruz.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                            <span>10+ Yıl Deneyim</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-blue-400 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
                            <span>50+ Kurumsal Proje</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-purple-400 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
                            <span>100% Müşteri Memnuniyeti</span>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="glass-effect p-8 rounded-3xl animate-float">
                        <div class="text-6xl mb-4">🎯</div>
                        <h4 class="text-2xl font-bold mb-4 text-gradient">Misyonumuz</h4>
                        <p class="text-gray-200">
                            İş hedeflerinizi hızla hayata geçiren, sürdürülebilir ve ölçümlenebilir yazılım ürünleri geliştirerek rekabet avantajı sağlamanız.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-5xl md:text-6xl font-bold mb-6 text-gradient">
                    Hizmetlerimiz
                </h2>
                <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                    Stratejiden ürüne; analiz, tasarım, geliştirme ve bakım aşamalarında yanınızdayız.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Frontend -->
                <div class="glass-effect p-6 rounded-2xl hover:scale-105 transition-all duration-500 glow-border">
                    <div class="text-4xl mb-4">🎨</div>
                    <h3 class="text-xl font-bold mb-3 text-gradient">Frontend</h3>
                    <div class="space-y-2 text-sm">
                        <div class="bg-white/10 px-3 py-1 rounded-full">React.js</div>
                        <div class="bg-white/10 px-3 py-1 rounded-full">Vue.js</div>
                        <div class="bg-white/10 px-3 py-1 rounded-full">Tailwind CSS</div>
                        <div class="bg-white/10 px-3 py-1 rounded-full">TypeScript</div>
                    </div>
                </div>
                
                <!-- Backend -->
                <div class="glass-effect p-6 rounded-2xl hover:scale-105 transition-all duration-500 glow-border">
                    <div class="text-4xl mb-4">⚡</div>
                    <h3 class="text-xl font-bold mb-3 text-gradient">Backend</h3>
                    <div class="space-y-2 text-sm">
                        <div class="bg-white/10 px-3 py-1 rounded-full">Laravel</div>
                        <div class="bg-white/10 px-3 py-1 rounded-full">Node.js</div>
                        <div class="bg-white/10 px-3 py-1 rounded-full">Python</div>
                        <div class="bg-white/10 px-3 py-1 rounded-full">PostgreSQL</div>
                    </div>
                </div>
                
                <!-- Mobile -->
                <div class="glass-effect p-6 rounded-2xl hover:scale-105 transition-all duration-500 glow-border">
                    <div class="text-4xl mb-4">📱</div>
                    <h3 class="text-xl font-bold mb-3 text-gradient">Mobile</h3>
                    <div class="space-y-2 text-sm">
                        <div class="bg-white/10 px-3 py-1 rounded-full">React Native</div>
                        <div class="bg-white/10 px-3 py-1 rounded-full">Flutter</div>
                        <div class="bg-white/10 px-3 py-1 rounded-full">iOS</div>
                        <div class="bg-white/10 px-3 py-1 rounded-full">Android</div>
                    </div>
                </div>
                
                <!-- DevOps -->
                <div class="glass-effect p-6 rounded-2xl hover:scale-105 transition-all duration-500 glow-border">
                    <div class="text-4xl mb-4">🚀</div>
                    <h3 class="text-xl font-bold mb-3 text-gradient">DevOps</h3>
                    <div class="space-y-2 text-sm">
                        <div class="bg-white/10 px-3 py-1 rounded-full">Docker</div>
                        <div class="bg-white/10 px-3 py-1 rounded-full">AWS</div>
                        <div class="bg-white/10 px-3 py-1 rounded-full">CI/CD</div>
                        <div class="bg-white/10 px-3 py-1 rounded-full">Kubernetes</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-5xl md:text-6xl font-bold mb-6 text-gradient">
                    Referanslar
                </h2>
                <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                    Çeşitli sektörlerde başarıyla teslim ettiğimiz projelerden seçkiler.
                </p>
            </div>
            
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Project 1 -->
                <div class="glass-effect rounded-3xl overflow-hidden hover:scale-105 transition-all duration-500 group">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <div class="text-3xl mb-2">🌐</div>
                            <h3 class="text-xl font-bold">E-Ticaret Platformu</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-300 mb-4">
                            Modern React.js ve Laravel ile geliştirilmiş, 
                            yüksek performanslı e-ticaret çözümü.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-blue-500/20 text-blue-300 px-2 py-1 rounded text-sm">React</span>
                            <span class="bg-red-500/20 text-red-300 px-2 py-1 rounded text-sm">Laravel</span>
                            <span class="bg-green-500/20 text-green-300 px-2 py-1 rounded text-sm">Tailwind</span>
                        </div>
                        <button class="w-full glass-effect py-2 rounded-lg hover:bg-white/20 transition-all duration-300">
                            Detayları Gör
                        </button>
                    </div>
                </div>
                
                <!-- Project 2 -->
                <div class="glass-effect rounded-3xl overflow-hidden hover:scale-105 transition-all duration-500 group">
                    <div class="h-48 bg-gradient-to-br from-purple-500 to-pink-600 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <div class="text-3xl mb-2">📱</div>
                            <h3 class="text-xl font-bold">Mobil Uygulama</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-300 mb-4">
                            React Native ile cross-platform mobil uygulama. 
                            iOS ve Android için optimize edildi.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-blue-500/20 text-blue-300 px-2 py-1 rounded text-sm">React Native</span>
                            <span class="bg-purple-500/20 text-purple-300 px-2 py-1 rounded text-sm">TypeScript</span>
                            <span class="bg-yellow-500/20 text-yellow-300 px-2 py-1 rounded text-sm">Firebase</span>
                        </div>
                        <button class="w-full glass-effect py-2 rounded-lg hover:bg:white/20 transition-all duration-300">
                            Detayları Gör
                        </button>
                    </div>
                </div>
                
                <!-- Project 3 -->
                <div class="glass-effect rounded-3xl overflow-hidden hover:scale-105 transition-all duration-500 group">
                    <div class="h-48 bg-gradient-to-br from-green-500 to-teal-600 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <div class="text-3xl mb-2">🤖</div>
                            <h3 class="text-xl font-bold">AI Dashboard</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-300 mb-4">
                            Yapay zeka destekli analitik dashboard. 
                            Python ve Vue.js ile geliştirildi.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-green-500/20 text-green-300 px-2 py-1 rounded text-sm">Vue.js</span>
                            <span class="bg-blue-500/20 text-blue-300 px-2 py-1 rounded text-sm">Python</span>
                            <span class="bg-orange-500/20 text-orange-300 px-2 py-1 rounded text-sm">TensorFlow</span>
                        </div>
                        <button class="w-full glass-effect py-2 rounded-lg hover:bg-white/20 transition-all duration-300">
                            Detayları Gör
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 relative">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-5xl md:text-6xl font-bold mb-6 text-gradient">
                İletişim
            </h2>
            <p class="text-xl text-gray-200 mb-12">
                İhtiyacınıza özel çözümler için bizimle iletişime geçin.
            </p>
            
            <div class="glass-effect p-8 rounded-3xl mb-8">
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="text-4xl mb-4">📧</div>
                        <h3 class="text-xl font-bold mb-2 text-gradient">Email</h3>
                        <p class="text-gray-300">frkndrbg@gmail.com</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl mb-4">📱</div>
                        <h3 class="text-xl font-bold mb-2 text-gradient">Telefon</h3>
                        <p class="text-gray-300">+90 542 316 54 17</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl mb-4">🌐</div>
                        <h3 class="text-xl font-bold mb-2 text-gradient">Sosyal Medya</h3>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="glass-effect w-10 h-10 rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
                                <span class="text-blue-400">Li</span>
                            </a>
                            <a href="#" class="glass-effect w-10 h-10 rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
                                <span class="text-gray-400">Gh</span>
                            </a>
                            <a href="#" class="glass-effect w-10 h-10 rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
                                <span class="text-blue-400">Tw</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <button onclick="openQuoteModal()" class="glow-border glass-effect px-12 py-4 rounded-full text-xl font-semibold hover:scale-105 transition-all duration-300 animate-pulse-glow">
🚀 Teklif Alın
            </button>
        </div>
    </section>

    <!-- Quote Modal -->
    <div id="quoteModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-4">
        <div class="glass-effect rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-8">
                <!-- Modal Header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-3xl font-bold text-gradient">💼 Teklif Talep Formu</h2>
                    <button onclick="closeQuoteModal()" class="glass-effect w-10 h-10 rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
                        <span class="text-xl">×</span>
                    </button>
                </div>
                
                <!-- Form -->
                <form id="quoteForm" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Ad Soyad -->
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-200">Ad Soyad *</label>
                            <input type="text" name="fullName" required class="w-full px-4 py-3 rounded-xl glass-effect border border-white/20 focus:border-cyan-400 focus:outline-none transition-all duration-300 text-white placeholder-gray-400" placeholder="Adınız ve soyadınız">
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-200">E-posta *</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl glass-effect border border-white/20 focus:border-cyan-400 focus:outline-none transition-all duration-300 text-white placeholder-gray-400" placeholder="ornek@email.com">
                        </div>
                        
                        <!-- Telefon -->
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-200">Telefon *</label>
                            <input type="tel" name="phone" required class="w-full px-4 py-3 rounded-xl glass-effect border border-white/20 focus:border-cyan-400 focus:outline-none transition-all duration-300 text-white placeholder-gray-400" placeholder="+90 555 123 45 67">
                        </div>
                        
                        <!-- Şirket -->
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-200">Şirket/Kurum</label>
                            <input type="text" name="company" class="w-full px-4 py-3 rounded-xl glass-effect border border-white/20 focus:border-cyan-400 focus:outline-none transition-all duration-300 text-white placeholder-gray-400" placeholder="Şirket adınız">
                        </div>
                    </div>
                    
                    <!-- Proje Türü -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-200">Proje Türü *</label>
                        <select name="projectType" required class="w-full px-4 py-3 rounded-xl glass-effect border border-white/20 focus:border-cyan-400 focus:outline-none transition-all duration-300 text-white">
                            <option value="">Proje türünü seçin</option>
                            <option value="web">Web Uygulaması</option>
                            <option value="mobile">Mobil Uygulama</option>
                            <option value="desktop">Desktop Uygulama</option>
                            <option value="ecommerce">E-Ticaret</option>
                            <option value="crm">CRM Sistemi</option>
                            <option value="erp">ERP Sistemi</option>
                            <option value="api">API Geliştirme</option>
                            <option value="other">Diğer</option>
                        </select>
                    </div>
                    
                    <!-- Bütçe -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-200">Tahmini Bütçe</label>
                        <select name="budget" class="w-full px-4 py-3 rounded-xl glass-effect border border-white/20 focus:border-cyan-400 focus:outline-none transition-all duration-300 text-white">
                            <option value="">Bütçe aralığını seçin</option>
                            <option value="0-25000">0 - 25.000 TL</option>
                            <option value="25000-50000">25.000 - 50.000 TL</option>
                            <option value="50000-100000">50.000 - 100.000 TL</option>
                            <option value="100000-250000">100.000 - 250.000 TL</option>
                            <option value="250000+">250.000 TL+</option>
                        </select>
                    </div>
                    
                    <!-- Proje Detayları -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-200">Proje Detayları *</label>
                        <textarea name="projectDetails" required rows="4" class="w-full px-4 py-3 rounded-xl glass-effect border border-white/20 focus:border-cyan-400 focus:outline-none transition-all duration-300 text-white placeholder-gray-400 resize-none" placeholder="Projeniz hakkında detaylı bilgi verin..."></textarea>
                    </div>
                    
                    <!-- Zaman Çizelgesi -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-200">Teslim Tarihi</label>
                        <select name="timeline" class="w-full px-4 py-3 rounded-xl glass-effect border border-white/20 focus:border-cyan-400 focus:outline-none transition-all duration-300 text-white">
                            <option value="">Zaman çizelgesini seçin</option>
                            <option value="asap">En kısa sürede</option>
                            <option value="1month">1 ay içinde</option>
                            <option value="3months">3 ay içinde</option>
                            <option value="6months">6 ay içinde</option>
                            <option value="flexible">Esnek</option>
                        </select>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button type="submit" class="flex-1 glow-border glass-effect px-8 py-4 rounded-xl text-lg font-semibold hover:scale-105 transition-all duration-300 animate-pulse-glow">
                            🚀 Teklif Gönder
                        </button>
                        <button type="button" onclick="closeQuoteModal()" class="glass-effect px-8 py-4 rounded-xl text-lg font-semibold hover:scale-105 transition-all duration-300 border border-white/30">
                            ❌ İptal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-8 glass-effect mt-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="text-center mb-4">
                <div class="text-2xl font-bold text-gradient">FURDER YAZILIM VE TEKNOLOJİ HİZMETLERİ</div>
            </div>
            <p class="text-gray-300">
                © 2025 Furder Yazılım ve Teknoloji Hizmetleri. Tüm hakları saklıdır.
            </p>
            <p class="text-sm text-gray-400 mt-2">
                Hayal gücünüzle sınırlı dijital çözümler ✨
            </p>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 100) {
                nav.style.backgroundColor = 'rgba(0, 0, 0, 0.3)';
            } else {
                nav.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
            }
        });

        // Modal Functions
        function openQuoteModal() {
            const modal = document.getElementById('quoteModal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeQuoteModal() {
            const modal = document.getElementById('quoteModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('quoteForm').reset();
        }

        // Close modal when clicking outside
        document.getElementById('quoteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeQuoteModal();
            }
        });

        // Form submission
        document.getElementById('quoteForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            // Show success message
            alert('✅ Teklif talebiniz başarıyla gönderildi! En kısa sürede size dönüş yapacağız.');
            
            // Close modal
            closeQuoteModal();
            
            // Here you can add actual form submission logic
            console.log('Form Data:', data);
        });

        // Interactive elements
        document.querySelectorAll('.glass-effect').forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            element.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>
