    {{$script ?? ''}}
    @stack('script')

    <script src="https://xentixar.github.io/formlytic/src/js/form.js"></script>
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-sm">&copy; {{ date('Y') }} Ecommerce. All rights reserved.</p>
                </div>
                <div class="flex gap-4 text-sm">
                    <a href="#" class="hover:text-gray-300">Privacy Policy</a>
                    <a href="#" class="hover:text-gray-300">Terms of Service</a>
                    <a href="#" class="hover:text-gray-300">Contact</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
