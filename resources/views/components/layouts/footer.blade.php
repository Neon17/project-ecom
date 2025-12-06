    {{$script ?? ''}}
    @stack('script')

    <script src="https://xentixar.github.io/formlytic/src/js/form.js"></script>
    <footer class="bg-blue-800 dark:bg-slate-800 text-white py-8 mt-auto border-t border-blue-900 dark:border-slate-700">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-sm text-blue-100 dark:text-slate-300">&copy; {{ date('Y') }} Ecommerce. All rights reserved.</p>
                </div>
                <div class="flex gap-6 text-sm text-blue-100 dark:text-slate-300">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-white transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>