<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ePRESCRYB</title>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;800&display=swap" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" />

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">ePRESCRYB</div>
            <ul class="nav-menu">
                <li><a href="#services" class="nav-link">SERVICES</a></li>
                <li><a href="#doctors" class="nav-link">DOCTORS</a></li>
                <li><a href="#about" class="nav-link">ABOUT US</a></li>
                <li><a href="#support" class="nav-link">SUPPORT</a></li>
            </ul>
            <a href="{{ route('login') }}" class="login-btn">LOGIN</a>
            <div class="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-text">
                    <p class="hero-title">
                        Automated Electronic Medical<br />
                        <span class="hero-subtitle">Prescriptions for your community</span>
                    </p>
                    <div class="hero-tagline">
                        <h1 class="tagline">— at your community.</h1>
                    </div>
                    <p class="hero-description">
                        Developed with local needs in mind.
                        Empower your health workers to deliver care
                        that is real-time, without the hassle.
                    </p>
                    <button class="cta-btn">GET STARTED</button>
                </div>

                <div class="hero-image">
                    <div class="hero-card">
                        <img src="{{ asset('assets/pic_landing.png') }}" alt="Healthcare professional" class="hero-img" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="services-container">
            <div class="section-header">
                <h2 class="section-title gradient-text">Healthcare That Comes to You</h2>
                <p class="section-description">
                    Automated Medical Prescriptions and Drug Database Created by Doctors for Doctors.
                </p>
            </div>

            <div class="services-grid">
                <div class="service-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="service-image">
                        <img src="{{ asset('assets/Card1v2.jpg') }}"
                             alt="Remote Care-Convenient Care" />
                    </div>
                    <h3 class="service-title">Remote Care,<br />Convenient Care</h3>
                    <p class="service-description">
                        With teleconsultation and e-prescriptions,patients can access timely medical management close to their homes—safe, efficient, and personalized.
                    </p>
                </div>

                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-image">
                        <img src="{{ asset('assets/Card2.jpg') }}"
                             alt="Smarter Prescriptions-Better Outcomes" />
                    </div>
                    <h3 class="service-title">Smarter Prescriptions,<br />Better Outcomes</h3>
                    <p class="service-description">
                        With access to reliable, up-to-date drug information and automated prescription, doctors can provide accurate e-prescriptions with lesser work—minimizing errors and maximizing safety.
                    </p>
                </div>

                <div class="service-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-image">
                        <img src="{{ asset('assets/Card3.jpg') }}"
                             alt="Local Connections-Lasting Impact" />
                    </div>
                    <h3 class="service-title">Local Connections,<br />Lasting Impact</h3>
                    <p class="service-description">
                        We combine technology with community engagement for a more responsive health system. Our services are grounded in local needs—ensuring accessible, culturally-sensitive care right where it matters most.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="statistics" id="statistics">
        <div class="statistics-bg">
            <div class="statistics-logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="1625" height="425" viewBox="0 0 1925 425" fill="none">
                    <path d="M1366.79 253.757C1486.02 169.791 1712.16 144.041 1821.87 166.939C1931.59 189.837 1966.88 263.296 1915.37 355.84C1881.86 416.031 1775.67 451.923 1749.51 459.994C1745.91 461.103 1742.04 459.994 1739.5 457.222L1717.04 432.728C1714.68 430.15 1715.61 425.979 1718.81 424.586C1748.64 411.635 1868.03 355.658 1857.17 293.827C1847.01 235.959 1758.9 223.226 1712.16 253.757C1612.86 318.613 1621.58 455.649 1684.49 556.191C1723.74 618.916 1776.81 674.025 1828.03 718.645C1936.21 591.934 2030.99 483.075 2163.68 332.943C2192.3 293.821 2221.88 327.213 2189.44 362.518C2062.46 523.815 1971.51 634.981 1869.79 753.211C1934.67 804.319 1988.71 835.64 1995.51 840.498C2008.87 850.04 2001.66 855.385 1982.15 858.625C1941.13 860.635 1884.35 842.812 1820.44 810.158C1780.16 856.354 1737.26 904.867 1689.2 958.807C1687.52 960.682 1685.69 962.461 1683.75 964.064L1592.45 1039.76C1589 1042.61 1584.19 1038.53 1586.44 1034.66L1642.5 938.668C1643.95 936.189 1645.64 933.8 1647.49 931.606C1693.02 877.633 1734.07 829.101 1772.61 783.731C1697.14 739.05 1615.28 677.024 1539.47 604.846C1539.47 604.846 1480.32 633.468 1487.95 820.463C1489.18 850.412 1487.87 886.127 1444.07 883.431C1382.05 879.613 1395.61 817.599 1390.64 770.851C1385.66 724.102 1394.92 543.19 1436.43 364.426C1442.41 338.667 1453.6 306.228 1416.4 309.091C1381.45 311.781 1364.88 338.666 1352.48 374.921C1344.01 399.674 1334.75 408.312 1308.59 408.312C1275.25 408.312 1263.8 326.288 1366.79 253.757ZM1564.32 -37.2361C1588.28 -81.8691 1647.57 -112.814 1693.13 -90.6609C1724.61 -75.3506 1729.39 -23.8788 1709.34 20.008C1685.43 72.365 1629.84 119.737 1577.69 95.3762C1527.63 71.9914 1538.19 11.4469 1564.32 -37.2361Z" fill="url(#paint0_linear_2154_25)"/>
                    <path d="M81.7891 -280.243C201.019 -364.209 427.156 -389.959 536.872 -367.061C646.588 -344.163 681.883 -270.704 630.369 -178.16C596.864 -117.969 490.672 -82.0768 464.508 -74.0057C460.914 -72.897 457.039 -74.0055 454.497 -76.7781L432.045 -101.272C429.682 -103.85 430.606 -108.021 433.814 -109.414C463.638 -122.365 583.03 -178.342 572.172 -240.173C562.01 -298.041 473.9 -310.774 427.156 -280.243C327.859 -215.387 336.579 -78.3509 399.488 22.1906C438.736 84.9161 491.808 140.025 543.029 184.645C651.213 57.9345 745.987 -50.9247 878.682 -201.057C907.303 -240.179 936.879 -206.787 904.441 -171.482C777.463 -10.1845 686.513 100.981 584.787 219.211C649.671 270.319 703.707 301.64 710.509 306.498C723.866 316.04 716.658 321.385 697.152 324.625C656.131 326.635 599.347 308.812 535.444 276.158C495.156 322.354 452.256 370.867 404.195 424.807C402.524 426.682 400.686 428.461 398.752 430.064L307.448 505.76C304.005 508.615 299.186 504.526 301.441 500.663L357.503 404.668C358.951 402.189 360.642 399.8 362.493 397.606C408.024 343.633 449.069 295.101 487.607 249.731C412.137 205.05 330.278 143.024 254.468 70.8459C254.468 70.8459 195.317 99.4679 202.954 286.463C204.177 316.412 202.871 352.127 159.067 349.431C97.0496 345.613 110.609 283.599 105.636 236.851C100.663 190.102 109.915 9.19027 151.431 -169.574C157.413 -195.333 168.599 -227.772 131.396 -224.909C96.4507 -222.219 79.8766 -195.334 67.4785 -159.079C59.0138 -134.326 49.7541 -125.688 23.5938 -125.688C-9.7483 -125.688 -21.2022 -207.712 81.7891 -280.243ZM279.321 -571.236C303.278 -615.869 362.571 -646.814 408.126 -624.661C439.61 -609.351 444.387 -557.879 424.345 -513.992C400.434 -461.635 344.836 -414.263 292.687 -438.624C242.627 -462.009 253.191 -522.553 279.321 -571.236Z" fill="url(#paint1_linear_2154_25)"/>
                    <defs>
                    <linearGradient id="paint0_linear_2154_25" x1="589.498" y1="-1271.7" x2="2259.21" y2="811.195" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#1A5D77"/>
                    <stop offset="1" stop-color="#143045"/>
                    </linearGradient>
                    <linearGradient id="paint1_linear_2154_25" x1="1536.5" y1="1364" x2="-141.891" y2="-173.102" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#1A5D77"/>
                    <stop offset="1" stop-color="#143045"/>
                    </linearGradient>
                    </defs>
                </svg>
            </div>
        </div>
        <div class="statistics-container">
            <div class="stats-wrapper">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="0">
                    <div class="stat-number" data-target="20">0</div>
                    <div class="stat-plus">+</div>
                    <div class="stat-label">Common diseases</div>
                    <div class="stat-description">covered in the app</div>
                </div>

                <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-number" data-target="100">0</div>
                    <div class="stat-plus">+</div>
                    <div class="stat-label">Prescriptions</div>
                    <div class="stat-description">stored in the database</div>
                </div>

                <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-number" data-target="20">0</div>
                    <div class="stat-plus">+</div>
                    <div class="stat-label">Medical Professionals</div>
                    <div class="stat-description">in the advisory board</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Advisory Board Section -->
    <!-- <section class="advisory" id="doctors">
        <div class="advisory-container">
            <div class="section-header">
                <h2 class="section-title">Our Medical Advisory Board</h2>
            </div>

            <div class="carousel-container">
                <div class="carousel-wrapper">
                    <div class="carousel-track" id="carousel-track">
                        <div class="advisor-card">
                            <img src="{{ asset('assets/dr_tupas.png') }}"
                                 alt="Dr. Genevieve Tupas" class="advisor-image" />
                            <h4 class="advisor-name">Dr. Genevieve Tupas</h4>
                            <p class="advisor-specialty">Physician | Research Faculty</p>
                        </div>
                        <div class="advisor-card">
                            <img src="{{ asset('assets/dr_plata.png') }}"
                                 alt="Dr. Maria Angelica Plata" class="advisor-image" />
                            <h4 class="advisor-name">Dr. Maria Angelica C. Plata, RN, MD</h4>
                            <p class="advisor-specialty">Physician | Research Faculty</p>
                        </div>

                        <div class="advisor-card">
                            <img src="{{ asset('assets/dr_gumarang.png') }}"
                                 alt="Dr. Jasper Gumarang" class="advisor-image" />
                            <h4 class="advisor-name">Dr. Jasper Gumarang</h4>
                            <p class="advisor-specialty">Physician | Former Medical Professor</p>
                        </div>

                        <div class="advisor-card">
                            <img src="{{ asset('assets/dr_johaimen.png') }}"
                                 alt="Dr. Johaimen Maca-Alang, MPM" class="advisor-image" />
                            <h4 class="advisor-name">Dr. Johaimen Maca-Alang, MPM</h4>
                            <p class="advisor-specialty">Certified Primary Care - Family Physician</p>
                        </div>

                        <div class="advisor-card">
                            <img src="{{ asset('assets/dr_seredrica.png') }}"
                                 alt="Dr. Kristine D. Seredrica" class="advisor-image" />
                            <h4 class="advisor-name">Dr. Kristine D. Seredrica</h4>
                            <p class="advisor-specialty">Physician | Medical Specialist</p>
                        </div>

                        <div class="advisor-card">
                            <img src="{{ asset('assets/dr_lupogan.png') }}"
                                 alt="Dr. Ofel Joy Faith A. Lupogan" class="advisor-image" />
                            <h4 class="advisor-name">Dr. Ofel Joy Faith A. Lupogan</h4>
                            <p class="advisor-specialty">Physician | Municipal Health Officer</p>
                        </div>

                        <div class="advisor-card">
                            q<img src="{{ asset('assets/dr_manuel.png') }}"
                                 alt="Dr. Maria Fatima Manuel, FPAFP" class="advisor-image" />
                            <h4 class="advisor-name">Dr. Maria Fatima Manuel, FPAFP</h4>
                            <p class="advisor-specialty">Physician - Family Medicine</p>
                        </div>

                        <div class="advisor-card">
                            <img src="{{ asset('assets/dr_buhay.png') }}"
                                 alt="Dr. Mikhail Ness Buhay" class="advisor-image" />
                            <h4 class="advisor-name">Dr. Mikhail Ness Buhay, RN</h4>
                            <p class="advisor-specialty">Medical Physician | Medical Professor</p>
                        </div>
                    </div>
                </div>

                <button class="carousel-btn prev-btn" id="prev-btn">
                    <i data-lucide="chevron-left"></i>
                </button>
                <button class="carousel-btn next-btn" id="next-btn">
                    <i data-lucide="chevron-right"></i>
                </button>
            </div>
        </div>
    </section> -->

    <!-- Medical Advisory Board Section -->
    <section class="advisory" id="doctors">
        <div class="section-header">
            <h2 class="section-title">Our Medical Advisory Board</h2>
        </div>
        <div class="advisory-container">
            <div class="hierarchy-container">
                <!-- Project Leader -->
                <div class="level-container">
                    <h3 class="level-title">Project Leader / Database Creator</h3>
                    <div class="cards-grid single">
                        <div class="advisor-card" onclick="toggleCard(this)">
                            <img src= "{{ asset('assets/dr_lyka.png') }}" alt="Dr. MAP" class="advisor-image" />
                            <h4 class="advisor-name">Dr. Maria Angelica C. Plata, RN</h4>
                            <p class="advisor-specialty">Physician | Research Faculty</p>
                            <div class="additional-info">
                                <p>Dr. Maria Angelica C. Plata is a dedicated physician and research faculty member who
                                    serves as the project leader and database creator for our medical advisory board
                                    initiative.</p>
                                <h5>Expertise:</h5>
                                <ul>
                                    <li>Medical research and database management</li>
                                    <li>Healthcare system optimization</li>
                                    <li>Medical education and training</li>
                                    <li>Clinical practice guidelines development</li>
                                </ul>
                                <p>With extensive experience in both clinical practice and academic research, Dr. Plata
                                    has been instrumental in developing comprehensive medical databases that serve
                                    healthcare professionals across the region.</p>
                            </div>
                            <div class="expand-indicator">+</div>
                        </div>
                    </div>
                </div>

                <!-- Show More Button -->
                <div class="show-more-container">
                    <button class="show-more-btn" onclick="toggleContent()">
                        <span id="btn-text">Show More</span>
                    </button>
                </div>

                <!-- Hidden Content -->
                <div class="hidden-content" id="hidden-content">
                    <!-- Medical Advisory Board -->
                    <div class="level-container">
                        <h3 class="level-title">Medical Advisory Board</h3>
                        <div class="cards-grid multi">
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_tupas.jpeg') }}" alt="Dr. GDT" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Genevieve Dable-Tupas, FPPS, MMCE</h4>
                                <p class="advisor-specialty">Center for Research Development (CRD) Director</p>
                                <div class="additional-info">
                                    <p>Dr. Genevieve Dable-Tupas serves as the Director of the Center for Research
                                        Development, bringing extensive expertise in medical research coordination and
                                        development.</p>
                                    <h5>Leadership Role:</h5>
                                    <ul>
                                        <li>Research program development and oversight</li>
                                        <li>Medical education curriculum design</li>
                                        <li>Inter-departmental collaboration facilitation</li>
                                        <li>Quality assurance in medical research</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_hontiveros.png') }}" alt="Dr. ERH" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Erwin Rommel N. Hontiveros, MHPed</h4>
                                <p class="advisor-specialty">Physician | Chief Operations Officer (COO)</p>
                                <div class="additional-info">
                                    <p>Dr. Erwin Rommel N. Hontiveros combines clinical expertise with operational
                                        leadership as Chief Operations Officer, ensuring seamless healthcare delivery
                                        systems.</p>
                                    <h5>Operational Excellence:</h5>
                                    <ul>
                                        <li>Healthcare operations management</li>
                                        <li>Process optimization and efficiency</li>
                                        <li>Staff development and training</li>
                                        <li>Strategic planning and implementation</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_hyacinth.png') }}" alt="Dr. MAHB" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Marie Aimee Hyacinth V. Bretaña, FPPS AP, FPAAB</h4>
                                <p class="advisor-specialty">Physician | Medical Educator</p>
                                <div class="additional-info">
                                    <p>Dr. Marie Aimee Hyacinth V. Bretaña is a distinguished medical educator with
                                        fellowship credentials, dedicated to advancing medical education and clinical
                                        practice.</p>
                                    <h5>Educational Leadership:</h5>
                                    <ul>
                                        <li>Medical curriculum development</li>
                                        <li>Clinical skills training</li>
                                        <li>Professional development programs</li>
                                        <li>Medical board examination preparation</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_platero2.png') }}" alt="Dr. MP" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Marieldo S. Platero</h4>
                                <p class="advisor-specialty">Physician | Faculty Member</p>
                                <div class="additional-info">
                                    <p>Dr. Marieldo S. Platero brings valuable clinical experience and academic
                                        expertise as a faculty member, contributing to medical education and patient
                                        care excellence.</p>
                                    <h5>Academic Contributions:</h5>
                                    <ul>
                                        <li>Clinical instruction and mentorship</li>
                                        <li>Medical research participation</li>
                                        <li>Student assessment and evaluation</li>
                                        <li>Continuing medical education</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_luisa2.png') }}" alt="Dr. MLLB" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Ma. Luisa P. Llanes‑Bisnar, MD, FPCP, AFPCP</h4>
                                <p class="advisor-specialty">Physician | Medicine Educator</p>
                                <div class="additional-info">
                                    <p>Dr. Ma. Luisa P. Llanes‑Bisnar is a board-certified physician with fellowship
                                        training, specializing in internal medicine education and clinical practice.</p>
                                    <h5>Clinical Expertise:</h5>
                                    <ul>
                                        <li>Internal medicine specialization</li>
                                        <li>Clinical case management</li>
                                        <li>Medical education methodology</li>
                                        <li>Professional medical training</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                        </div>
                    </div>
                    <!-- Technical Advisory Board -->
                    <div class="level-container">
                        <h3 class="level-title">Technical Advisory Board</h3>
                        <div class="cards-grid multi">
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_palma.png') }}" alt="Dr. MP" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Mechelle Acero Palma, MMHoA, PhD, CFP, DipIBLM, DPCLM,
                                    FACLM, FPCLM</h4>
                                <p class="advisor-specialty">Physician | Medical Professor</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/bysshe_fernan.png') }}" alt="Dr. BF" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Byshee Fernan, CFP, MPH, DipIBLM, DPCLM, FPCLM</h4>
                                <p class="advisor-specialty">Family Medicine Physician</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/greg_formal.png') }}" alt="GC,Jr." class="advisor-image" />
                                <h4 class="advisor-name">Gregorio Candelario, Jr., MPA</h4>
                                <p class="advisor-specialty">Data Privacy Officer</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                        </div>
                    </div>
                    <!-- Teleconsult Doctors -->
                    <div class="level-container">
                        <h3 class="level-title">Teleconsult Doctors</h3>
                        <div class="cards-grid multi">
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_buhay.png') }}" alt="Dr. MNB" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Mikhail Ness Buhay, RN</h4>
                                <p class="advisor-specialty">Physician | Medical Professor</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_abundo.png') }}" alt="Dr. ICSA" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Ian Cornelius Sim Abundo, RN</h4>
                                <p class="advisor-specialty">Physician | Associate Professor</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_nica.jpg') }}" alt="Dr. JDR" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Joenica Dale A. Roque, RN</h4>
                                <p class="advisor-specialty">Physician</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_gladys.png') }}" alt="Dr. GOS" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Gladys Ogatis Sermon</h4>
                                <p class="advisor-specialty">Physician - Family Medicine</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_manuel.png') }}" alt="Dr. MFM" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Maria Fatima Manuel, FPAFP</h4>
                                <p class="advisor-specialty">Physician - Family Medicine</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                        </div>
                    </div>
                    <!-- Database Organizers -->
                    <div class="level-container">
                        <h3 class="level-title">Database Organizers</h3>
                        <div class="cards-grid multi">
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_gumarang.png') }}" alt="Dr. JG" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Jasper B. Gumarang</h4>
                                <p class="advisor-specialty">Physician | Former Medical Professor</p>
                                <div class="additional-info">
                                    <p>Dr. Jasper B. Gumarang brings extensive academic and clinical experience as a
                                        former medical professor, now contributing to database organization and medical
                                        information management.</p>
                                    <h5>Database Management:</h5>
                                    <ul>
                                        <li>Medical data organization</li>
                                        <li>Information system development</li>
                                        <li>Academic research coordination</li>
                                        <li>Medical knowledge documentation</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_johaimen.png') }}" alt="Dr. JMA" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Johaimen Maca-Alang, MPM</h4>
                                <p class="advisor-specialty">Certified Primary Care - Family Physician</p>
                                <div class="additional-info">
                                    <p>Dr. Johaimen Maca-Alang is a certified primary care family physician with a
                                        Master's in Project Management, bringing unique expertise in healthcare
                                        management and family medicine.</p>
                                    <h5>Primary Care Excellence:</h5>
                                    <ul>
                                        <li>Family medicine practice</li>
                                        <li>Primary care coordination</li>
                                        <li>Healthcare project management</li>
                                        <li>Community health initiatives</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_lupogan.png') }}" alt="Dr. OJFL" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Ofel Joy Faith A. Lupogan</h4>
                                <p class="advisor-specialty">Physician | Municipal Health Officer</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_seredrica1.png') }}" alt="Dr. KS" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Kristine D. Seredrica</h4>
                                <p class="advisor-specialty">Physician | Medical Specialist</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_abundo.png') }}" alt="Dr. ICSA" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Ian Cornelius Sim Abundo, RN</h4>
                                <p class="advisor-specialty">Physician | Associate Professor</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/dr_gnar.png') }}" alt="Dr. GYE" class="advisor-image" />
                                <h4 class="advisor-name">Dr. Mikael Gnar Yu Ekey</h4>
                                <p class="advisor-specialty">Occupational Health Physician</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                        </div>
                    </div>
                    <!-- Project staff -->
                    <div class="level-container" onclick="toggleCard(this)">
                        <h3 class="level-title">Project Staff</h3>
                        <div class="cards-grid multi">
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/Bante_formal.png') }}" alt="SB" class="advisor-image" />
                                <h4 class="advisor-name">Shenivel E. Bante, LPT</h4>
                                <p class="advisor-specialty">Administrative Staff</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/Andres_Formal.jpg') }}" alt="JMA" class="advisor-image" />
                                <h4 class="advisor-name">Jasmine M. Andres</h4>
                                <p class="advisor-specialty">Project Development Officer</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/Besana_formal.png') }}" alt="JBB" class="advisor-image" />
                                <h4 class="advisor-name">Joshua B. Besana</h4>
                                <p class="advisor-specialty">Junior Programmer</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/Besana_formal.png') }}" alt="WPC" class="advisor-image" />
                                <h4 class="advisor-name">William Pol Crumb</h4>
                                <p class="advisor-specialty">Senior Programmer</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/Manliguez_Formal.jpg') }}" alt="BNM" class="advisor-image" />
                                <h4 class="advisor-name">Bridgette Nicolette C. Manliguez</h4>
                                <p class="advisor-specialty">Graphic Designer</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/Blanco_formal.png') }}" alt="MIB" class="advisor-image" />
                                <h4 class="advisor-name">Ma. Isabel H. Blanco, RMT</h4>
                                <p class="advisor-specialty">Field Staff</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                            <div class="advisor-card" onclick="toggleCard(this)">
                                <img src="{{ asset('assets/Alvez_formal.png') }}" alt="RRA" class="advisor-image" />
                                <h4 class="advisor-name">Rubel Rio P. Alvez</h4>
                                <p class="advisor-specialty">Field Staff</p>
                                <div class="additional-info">
                                    <p>lorem ipsum</p>
                                    <h5>lorem ipsum</h5>
                                    <ul>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                        <li>lorem ipsum</li>
                                    </ul>
                                </div>
                                <div class="expand-indicator">+</div>
                            </div>
                        </div>
                    </div>
                    <!-- Whole container end below-->
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="support">
        <div class="footer-bg">
            <div class="footer-logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="578" height="582" viewBox="0 0 578 740" fill="none">
                <path d="M234.659 817L3.40909 565.134L106.818 519.082L110.227 566.84C115.224 609.882 125.609 624.263 160.227 624.263C179.545 624.263 201.136 618.009 201.136 578.211C201.136 480.99 220.455 466.207 220.455 466.207C307.386 554.901 415.341 603.138 460.227 608.912C505.114 614.687 523.295 584.465 490.341 564.566C417.457 520.556 387.107 490.862 330.682 424.704L503.409 350.224L725 584.465L234.659 817Z" fill="#7CAD3E" fill-opacity="0.1"/>
                <path d="M154.388 296.04C157.951 280.689 164.613 261.358 142.457 263.064C121.645 264.667 111.775 280.689 104.391 302.294C99.3502 317.045 93.8354 322.193 78.2557 322.193C58.3989 322.193 51.5776 273.312 112.914 230.089C183.921 180.051 318.596 164.706 383.937 178.352C449.278 191.997 470.298 235.774 439.619 290.924C420.807 324.741 363.518 345.687 343.966 352.004C339.899 353.318 335.527 352.047 332.639 348.894L324.152 339.629C321.467 336.698 322.477 331.958 326.1 330.323C348.188 320.354 411.057 288.712 404.96 253.968C398.908 219.482 346.434 211.895 318.596 230.089C259.46 268.739 264.653 350.403 302.119 410.318C362.911 507.539 479.391 574.059 487.346 579.745C495.301 585.431 491.008 588.616 479.391 590.547C421.434 593.389 310.638 529.712 215.752 439.313C215.752 439.313 180.525 456.37 185.073 567.805C185.801 585.653 185.024 606.936 158.937 605.329C122.002 603.054 130.078 566.099 127.116 538.24C124.154 510.381 129.664 402.571 154.388 296.04Z" fill="#7CAD3E" fill-opacity="0.1"/>
                <path d="M316.921 90.7918C328.857 64.6385 326.012 33.9651 307.262 24.8412C280.132 11.6396 244.82 30.0804 230.553 56.6784C214.991 85.6901 208.7 121.77 238.513 135.706C269.57 150.223 302.681 121.993 316.921 90.7918Z" fill="#7CAD3E" fill-opacity="0.1"/>
                <path d="M0 548.646V168.858L198.295 101.201C196.109 107.245 206.318 166.441 264.773 156.919C338.068 144.979 342.045 64.8142 341.477 52.8747L503.409 0V332.599L321.591 411.627C314.702 401.891 298.487 378.094 291.477 346.244C280.764 297.57 313.068 237.084 357.955 239.358C399.946 241.485 396.023 284.841 325 311.563C275 325.208 309.091 355.341 309.091 355.341C323.15 371.75 331.651 375.354 349.432 370.692C349.432 370.692 426.857 342.869 452.841 301.898C471.591 272.333 477.875 216.798 443.75 188.189C401.705 152.939 328.409 149.647 259.091 160.898C178.977 173.903 54.7102 208.709 46.5909 304.172C42.0455 357.615 108.523 349.656 119.318 313.837C131.076 274.825 141.477 282.567 141.477 282.567C120.224 359.457 111 405.329 107.955 501.457L0 548.646Z" fill="#7CAD3E" fill-opacity="0.1"/>
                <path d="M604.527 295.154C623.931 274.082 606.239 254.151 589.118 277.502C470.076 411.893 402.054 490.874 281.477 633.488C279.622 635.682 277.931 638.066 276.48 640.545L248.423 688.483C246.164 692.343 250.979 696.436 254.425 693.585L300.864 655.169C302.799 653.568 304.637 651.795 306.31 649.921C422.305 520.001 488.095 442.732 604.527 295.154Z" fill="#486C33"/>
                </svg>
            </div>
        </div>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="brand-logo">
                        <i class="footer-icon">
                            <img src="{{ asset('assets/eP_oneliner.png') }}" alt="eP oneline">
                        </i>
                    </div>
                    <address class="footer-address">
                        <a href="mailto:telemedicine@dmsf.edu.ph" style="color: white">telemedicine@dmsf.edu.ph</a></p><br>
                        College of Medicine Building, Davao Medical School<br>
                        Foundation, Inc., Medical School Drive, Davao City,<br>
                        Philippines 8000
                    </address>
                </div>

                <div class="footer-links">
                    <div class="link-group">
                        <h4 class="link-title">Resources</h4>
                        <ul class="link-list">
                            <li><a href="#services">Services</a></li>
                            <li><a href="#doctors">Doctors</a></li>
                            <li><a href="#">Patients</a></li>
                            <li><a href="#">Locations</a></li>
                        </ul>
                    </div>

                    <div class="link-group">
                        <h4 class="link-title">Company</h4>
                        <ul class="link-list">
                            <li><a href="#about">About</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Press</a></li>
                            <li><a href="#">News</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="legal-links">
                    <a href="#">Terms of Use</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">List of Third Parties</a>
                    <a href="#">Restricted Substances</a>
                    <a href="#">Protected Businesses</a>
                </div>
                <div class="social-links">
                    <a href="#"><i data-lucide="facebook"></i></a>
                    <a href="#"><i data-lucide="linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize everything when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    // Initialize Lucide icons
    if (typeof lucide !== "undefined") {
        lucide.createIcons();
    }

    // Initialize all functionality
    initNavigation();
    initScrollAnimations();
    initCarousel();
    initCounters();
    initHeroAnimations();
});

// Navigation functionality
function initNavigation() {
    const navbar = document.querySelector(".navbar");
    const mobileMenu = document.querySelector(".mobile-menu");
    const navMenu = document.querySelector(".nav-menu");
    const logo = document.querySelector(".logo");

    // Navbar scroll effect
    window.addEventListener("scroll", function () {
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        }
    });

    // Mobile menu toggle
    if (mobileMenu && navMenu) {
        mobileMenu.addEventListener("click", function () {
            navMenu.classList.toggle("active");
            this.classList.toggle("active");
        });
    }

    // Logo click to scroll to top
    if (logo) {
        logo.addEventListener("click", function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    }

    // Smooth scrolling for navigation links
    const navLinks = document.querySelectorAll(".nav-link");
    navLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
            // Close mobile menu
            if (navMenu) navMenu.classList.remove("active");
            if (mobileMenu) mobileMenu.classList.remove("active");
        });

        // Hover animations
        link.addEventListener("mouseenter", function () {
            this.style.transform = "translateY(-2px)";
            this.style.color = "#4CAF50";
        });

        link.addEventListener("mouseleave", function () {
            this.style.transform = "translateY(0)";
            this.style.color = "#ffffff";
        });
    });

    // Button hover animations
    const buttons = document.querySelectorAll(".login-btn, .cta-btn");
    buttons.forEach((btn) => {
        btn.addEventListener("mouseenter", function () {
            this.style.transform = "translateY(-2px)";
        });

        btn.addEventListener("mouseleave", function () {
            this.style.transform = "translateY(0)";
        });
    });
}

// Scroll animations using Intersection Observer
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animate");

                // Trigger counter animation for statistics
                if (entry.target.classList.contains("statistics")) {
                    animateCounters();
                }
            }
        });
    }, observerOptions);

    // Observe service cards
    const serviceCards = document.querySelectorAll(".service-card");
    serviceCards.forEach((card) => {
        observer.observe(card);
    });

    // Observe stat items
    const statItems = document.querySelectorAll(".stat-item");
    statItems.forEach((item) => {
        observer.observe(item);
    });

    // Observe statistics section
    const statsSection = document.querySelector(".statistics");
    if (statsSection) {
        observer.observe(statsSection);
    }

    // Service card hover effects
    serviceCards.forEach((card) => {
        card.addEventListener("mouseenter", function () {
            this.style.transform = "translateY(-8px)";
            this.style.boxShadow =
                "0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)";
        });

        card.addEventListener("mouseleave", function () {
            this.style.transform = "translateY(0)";
            this.style.boxShadow = "0 4px 6px -1px rgba(0, 0, 0, 0.1)";
        });
    });
}

// Counter animation
function initCounters() {
    // This will be called by the intersection observer
}

function animateCounters() {
    const statNumbers = document.querySelectorAll(".stat-number");

    statNumbers.forEach((numberEl) => {
        const target = parseInt(numberEl.getAttribute("data-target"));
        const duration = 2000;
        const increment = target / (duration / 50);
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                numberEl.textContent = target;
                clearInterval(timer);
            } else {
                numberEl.textContent = Math.floor(current);
            }
        }, 50);
    });
}

// Initialize mobile menu styles
addMobileMenuStyles();

        function toggleContent() {
            const hiddenContent = document.getElementById('hidden-content');
            const btnText = document.getElementById('btn-text');

            if (hiddenContent.classList.contains('show')) {
                hiddenContent.classList.remove('show');
                btnText.textContent = 'Show More';
            } else {
                hiddenContent.classList.add('show');
                btnText.textContent = 'Show Less';
            }
        }

            //New script
        // Global variable to track modal state
let modalActive = false;

function toggleCard(card) {
    const additionalInfo = card.querySelector('.additional-info');
    const expandIndicator = card.querySelector('.expand-indicator');

    // If modal is already active and this isn't the active card, do nothing
    if (modalActive && !card.classList.contains('modal-active')) {
        return;
    }

    // Toggle the expanded state
    card.classList.toggle('expanded');
    additionalInfo.classList.toggle('expanded');

    // Handle modal state
    if (card.classList.contains('expanded')) {
        openModal(card);
        expandIndicator.textContent = '×';
        expandIndicator.classList.add('expanded');
    } else {
        closeModal(card);
        expandIndicator.textContent = '+';
        expandIndicator.classList.remove('expanded');
    }
}

function openModal(card) {
    modalActive = true;

    // Create overlay if it doesn't exist
    let overlay = document.querySelector('.modal-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'modal-overlay';
        document.body.appendChild(overlay);

        // Close modal when clicking overlay
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                closeAllModals();
            }
        });
    }

    // Activate modal
    overlay.classList.add('active');
    card.classList.add('modal-active');
    document.body.classList.add('modal-open');
}

function closeModal(card) {
    modalActive = false;

    const overlay = document.querySelector('.modal-overlay');
    const closeBtn = card.querySelector('.close-modal');

    if (overlay) {
        overlay.classList.remove('active');
    }

    if (closeBtn) {
        closeBtn.remove();
    }

    card.classList.remove('modal-active');
    document.body.classList.remove('modal-open');
}

function closeAllModals() {
    const activeCard = document.querySelector('.advisor-card.modal-active');
    if (activeCard) {
        const additionalInfo = activeCard.querySelector('.additional-info');
        const expandIndicator = activeCard.querySelector('.expand-indicator');

        activeCard.classList.remove('expanded');
        additionalInfo.classList.remove('expanded');
        expandIndicator.textContent = '+';
        expandIndicator.classList.remove('expanded');

        closeModal(activeCard);
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modalActive) {
        closeAllModals();
    }
});

function toggleContent() {
    const hiddenContent = document.getElementById('hidden-content');
    const btnText = document.getElementById('btn-text');

    if (hiddenContent.classList.contains('show')) {
        hiddenContent.classList.remove('show');
        btnText.textContent = 'Show More';
    } else {
        hiddenContent.classList.add('show');
        btnText.textContent = 'Show Less';
    }
}

// Footer links smooth scrolling
document.addEventListener("DOMContentLoaded", function () {
    const footerLinks = document.querySelectorAll('.footer a[href^="#"]');
    footerLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });
});

// Mobile menu CSS animations
function addMobileMenuStyles() {
    const style = document.createElement("style");
    style.textContent = `
        .nav-menu.active {
            display: flex !important;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #102A3C;
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .nav-menu.active li {
            margin: 0.5rem 0;
        }

        .mobile-menu.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .mobile-menu.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
        }
    `;
    document.head.appendChild(style);
}

// Initialize mobile menu styles
addMobileMenuStyles();

    </script>
</body>
</html>
