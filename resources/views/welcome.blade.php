<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- SAFE CHECK --}}
    @if(!isset($user) || !$user)
    <div class="flex items-center justify-center h-screen">
        <h1 class="text-2xl text-gray-400">Data user belum tersedia</h1>
    </div>
    @php return; @endphp
    @endif

    {{-- NAVBAR --}}
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between">
            <h1 class="font-bold text-lg">Protofolio MasKenn</h1>
            <div class="space-x-4 text-sm">
                <a href="#about" class="hover:text-blue-500">About</a>
                <a href="#skills" class="hover:text-blue-500">Skills</a>
                <a href="#experience" class="hover:text-blue-500">Experience</a>
                <a href="#projects" class="hover:text-blue-500">Projects</a>
                <a href="#contact" class="hover:text-blue-500">Contact</a>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4">

        {{-- HERO --}}
        <section class="bg-white py-20">
            <div class="max-w-5xl mx-auto px-6 grid md:grid-cols-2 items-center gap-10">

                {{-- LEFT TEXT --}}
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                        Kencana Putra Andhika
                    </h1>

                    <p class="mt-3 text-red-600 font-semibold">
                        Klub Favorite Manchester United Fans • Football Enthusiast
                    </p>

                    <p class="mt-6 text-gray-600 leading-relaxed">
                        Manchester United adalah klub Kesukaan Saya Dari Kecil sepak bola legendaris
                        asal Inggris. Dikenal dengan julukan
                        <b>"The Red Devils"</b>, klub ini memiliki sejarah panjang,
                        prestasi luar biasa, dan basis penggemar global.
                    </p>

                    <div class="mt-8 flex gap-4">
                        <a href="#projects"
                            class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                            Portfolio
                        </a>

                        <a href="#contact"
                            class="border border-gray-300 px-6 py-2 rounded-lg hover:bg-gray-100 transition">
                            Contact
                        </a>
                    </div>
                </div>

                {{-- RIGHT IMAGE --}}
                <div class="flex justify-center">
                    <div class="relative">
                        <img src="{{ asset('image/gym.png') }}"
                            class="w-72 h-72 object-cover rounded-2xl shadow-xl">

                        {{-- decorative circle --}}
                        <div class="absolute -top-5 -left-5 w-20 h-20 bg-red-500 rounded-full opacity-20"></div>
                        <div class="absolute -bottom-5 -right-5 w-20 h-20 bg-black rounded-full opacity-10"></div>
                    </div>
                </div>

            </div>
        </section>

        {{-- ABOUT --}}
        @if($user->about)
        <section id="about" class="py-16">
            <div class="max-w-5xl mx-auto px-6">

                {{-- Title --}}
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-900">About Me</h2>
                    <div class="w-16 h-1 bg-red-600 mx-auto mt-3 rounded"></div>
                </div>

                {{-- Card --}}
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition">

                    {{-- Description --}}
                    <p class="text-gray-700 leading-relaxed text-lg text-center max-w-3xl mx-auto">
                        Saya Ingin Menjadi Pelatih Manchester United
                    </p>

                    {{-- Info Grid --}}
                    <div class="grid md:grid-cols-2 gap-6 mt-10">

                        {{-- Vision --}}
                        <div class="bg-gray-50 p-5 rounded-xl border hover:border-red-500 transition">
                            <h3 class="font-semibold text-red-600 mb-2">🎯 Vision</h3>
                            <p class="text-gray-600 text-sm">
                                {{ $user->about->professional_vision }}
                            </p>
                        </div>

                        {{-- Mission --}}
                        <div class="bg-gray-50 p-5 rounded-xl border hover:border-red-500 transition">
                            <h3 class="font-semibold text-red-600 mb-2">🚀 Mission</h3>
                            <p class="text-gray-600 text-sm">
                                {{ $user->about->mission }}
                            </p>
                        </div>

                        {{-- Location --}}
                        <div class="bg-gray-50 p-5 rounded-xl border hover:border-red-500 transition">
                            <h3 class="font-semibold text-red-600 mb-2">📍 Location</h3>
                            <p class="text-gray-600 text-sm">
                                {{ $user->about->location }}
                            </p>
                        </div>

                        {{-- DOB --}}
                        <div class="bg-gray-50 p-5 rounded-xl border hover:border-red-500 transition">
                            <h3 class="font-semibold text-red-600 mb-2">🎂 Date of Birth</h3>
                            <p class="text-gray-600 text-sm">
                                {{ $user->about->date_of_birth }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        @endif

        {{-- SKILLS --}}
        <section id="skills" class="py-16">
            <div class="max-w-5xl mx-auto px-6">

                {{-- Title --}}
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-900">Skills</h2>
                    <div class="w-16 h-1 bg-red-600 mx-auto mt-3 rounded"></div>
                </div>

                {{-- Card --}}
                <div class="bg-white rounded-2xl shadow-lg p-8">

                    <div class="grid md:grid-cols-2 gap-6">

                        @foreach($user->skills as $skill)

                        <div class="p-5 rounded-xl border hover:border-red-500 transition">

                            {{-- Header --}}
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="font-semibold text-gray-800">
                                    {{ $skill->skill_name }}
                                </h3>

                                <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-600">
                                    {{ $skill->proficiency_level }}
                                </span>
                            </div>

                            {{-- Category --}}
                            <p class="text-sm text-gray-500 mb-3">
                                {{ $skill->category }}
                            </p>

                            {{-- Divider --}}
                            <div class="h-[1px] bg-gray-200"></div>

                            {{-- Footer --}}
                            <p class="text-xs text-gray-400 mt-2 italic">
                                Professional Skill
                            </p>

                        </div>

                        @endforeach

                    </div>

                </div>

            </div>
        </section>

        {{-- EXPERIENCE --}}
        <section id="experience" class="py-16">
            <div class="max-w-5xl mx-auto px-6">

                {{-- Title --}}
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-900">Experience</h2>
                    <div class="w-16 h-1 bg-red-600 mx-auto mt-3 rounded"></div>
                </div>

                {{-- Card --}}
                <div class="bg-white rounded-2xl shadow-lg p-8 space-y-6">

                    @foreach($user->experiences as $exp)

                    <div class="border-b pb-5 last:border-none">

                        {{-- Header --}}
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800">
                                    {{ $exp->position_title }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ $exp->organization_name }}
                                </p>
                            </div>

                            <span class="text-xs text-gray-400">
                                {{ $exp->start_date }} -
                                {{ $exp->is_current ? 'Present' : $exp->end_date }}
                            </span>
                        </div>

                        {{-- Description --}}
                        <p class="text-sm text-gray-600 mt-3 leading-relaxed">
                            {{ $exp->description }}
                        </p>

                    </div>

                    @endforeach

                </div>

            </div>
        </section>

        {{-- PROJECTS --}}
        <section id="projects" class="py-20 bg-gradient-to-b from-gray-50 to-white">
            <div class="max-w-6xl mx-auto px-6">

                {{-- Title --}}
                <div class="text-center mb-14">
                    <h2 class="text-4xl font-bold text-gray-900 tracking-tight">My Projects</h2>
                    <p class="text-gray-500 mt-2">Some of my recent work</p>
                    <div class="w-20 h-1 bg-red-500 mx-auto mt-4 rounded-full"></div>
                </div>

                {{-- Grid --}}
                <div class="grid md:grid-cols-2 gap-10">

                    @foreach($user->projects as $project)

                    <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">

                        {{-- IMAGE --}}
                        <div class="relative overflow-hidden">
                            <img
                                src="{{ $project->thumbnail 
                            ? asset('storage/' . $project->thumbnail) 
                            : asset('images/default.png') }}"
                                class="w-full h-52 object-cover group-hover:scale-105 transition duration-300">

                            {{-- overlay --}}
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition"></div>
                        </div>

                        {{-- CONTENT --}}
                        <div class="p-5 space-y-3">

                            {{-- Title --}}
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-red-500 transition">
                                {{ $project->project_title }}
                            </h3>

                            {{-- Meta --}}
                            <p class="text-xs text-gray-500">
                                {{ $project->project_type }} • {{ $project->role }}
                            </p>

                            {{-- Desc --}}
                            <p class="text-sm text-gray-600 line-clamp-2">
                                {{ $project->description }}
                            </p>

                            {{-- Date --}}
                            <p class="text-xs text-gray-400">
                                {{ $project->start_date }} —
                                {{ $project->is_ongoing ? 'Ongoing' : $project->end_date }}
                            </p>

                            {{-- TECHNOLOGIES --}}
                            @if($project->technologies)
                            <div class="flex flex-wrap gap-2 pt-2">
                                @foreach($project->technologies as $tech)
                                <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded-md">
                                    {{ $tech }}
                                </span>
                                @endforeach
                            </div>
                            @endif

                            {{-- BUTTON --}}
                            <div class="flex gap-3 pt-3">
                                @if($project->project_url)
                                <a href="{{ $project->project_url }}" target="_blank"
                                    class="text-sm px-3 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                                    Live
                                </a>
                                @endif

                                @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank"
                                    class="text-sm px-3 py-1.5 border border-gray-300 rounded-md hover:bg-gray-100 transition">
                                    GitHub
                                </a>
                                @endif
                            </div>

                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </section>

        {{-- KOLOM KANAN --}}
        <div class="space-y-6">
            @foreach($user->projects->skip(ceil($user->projects->count()/2)) as $project)

            <div class="border rounded-xl overflow-hidden hover:shadow-md transition">

                <img src="{{ $project->thumbnail ? asset('storage/'.$project->thumbnail) : 'https://via.placeholder.com/400x200' }}"
                    class="w-full h-40 object-cover">

                <div class="p-4">
                    <h3 class="font-semibold text-gray-800">
                        {{ $project->project_title }}
                    </h3>

                    <p class="text-xs text-gray-500 mb-2">
                        {{ $project->project_type }} • {{ $project->role }}
                    </p>

                    <p class="text-sm text-gray-600 line-clamp-2">
                        {{ $project->description }}
                    </p>

                    <p class="text-xs text-gray-400 mt-2">
                        {{ $project->start_date }} -
                        {{ $project->is_ongoing ? 'Ongoing' : $project->end_date }}
                    </p>

                    <div class="mt-2 flex gap-3 text-sm">
                        @if($project->project_url)
                        <a href="{{ $project->project_url }}" target="_blank"
                            class="text-red-600 hover:underline">Live</a>
                        @endif

                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank"
                            class="text-gray-700 hover:underline">GitHub</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
    </div>

    </section>

    {{-- CONTACT --}}
    <section id="contact" class="py-16">
        <div class="max-w-5xl mx-auto px-6">

            {{-- Title --}}
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900">Contact</h2>
                <div class="w-16 h-1 bg-red-600 mx-auto mt-3 rounded"></div>
            </div>

            {{-- Card --}}
            <div class="bg-white rounded-2xl shadow-lg p-8">

                <div class="divide-y">

                    @foreach($user->contacts->where('is_public', true) as $contact)

                    <div class="py-4 flex justify-between items-center">

                        {{-- Label --}}
                        <span class="text-sm text-gray-500">
                            {{ ucfirst($contact->contact_type) }}
                        </span>

                        {{-- Value --}}
                        <span class="font-medium text-gray-800">
                            {{ $contact->contact_value }}
                        </span>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>
    </section>

    </div>

    {{-- FOOTER --}}
    <footer class="bg-black text-white text-center py-4 mt-10">
        <p>© {{ date('Y') }} {{ $user->name }}. All rights reserved.</p>
    </footer>

</body>

</html>