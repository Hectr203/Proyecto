<footer class="w-full bg-surface-container-low mt-space-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
    <div class="w-full px-margin-mobile md:px-margin pt-space-xl pb-space-lg">
        <div class="bg-surface-container-lowest p-space-xl rounded-xl shadow-[0_4px_20px_-2px_rgba(29,29,31,0.04)] mb-space-xl flex flex-col lg:flex-row items-start lg:items-center justify-between gap-space-lg">
            <div class="max-w-xl">
                <span class="font-label-promotional text-label-promotional text-primary uppercase tracking-wider block mb-space-xs">The Lumen Journal</span>
                <h3 class="font-headline-md text-headline-md text-on-surface mb-space-xs">Clinical wellness insights delivered weekly.</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Receive peer-reviewed formulations, kinetic protocols, and invitations to private laboratory drops.</p>
            </div>
            <form class="flex items-center gap-space-sm w-full lg:w-auto">
                <input class="h-11 px-space-md rounded-full bg-surface-container-low font-body-sm text-body-sm text-on-surface placeholder:text-on-surface-variant focus:outline-none w-full sm:w-80 shadow-[inset_0_1px_0_0_rgba(255,255,255,0.9)]" placeholder="Enter your work or personal email" type="email"/>
                <button class="h-11 px-space-lg rounded-full bg-primary hover:bg-primary-container text-on-primary hover:text-on-primary-container font-label-md text-label-md transition-colors whitespace-nowrap shadow-sm" type="button">Subscribe</button>
            </form>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-space-lg pb-space-xl">
            <div class="col-span-2">
                <div class="flex items-center gap-space-sm mb-space-md">
                    <span class="font-headline-sm text-headline-sm uppercase text-on-surface">TechStore</span>
                </div>
                <p class="font-body-md text-body-md text-on-surface-variant max-w-sm mb-space-lg">Engineered for the best premium technology experience. Based in Zurich &amp; Santa Monica.</p>
                <div class="flex flex-wrap items-center gap-space-xs">
                    <span class="font-label-sm text-label-sm px-space-sm py-space-xs rounded-full bg-surface-container text-on-surface-variant">B-Corp Certified</span>
                    <span class="font-label-sm text-label-sm px-space-sm py-space-xs rounded-full bg-surface-container text-on-surface-variant">100% Carbon Neutral</span>
                </div>
            </div>
            <div>
                <h4 class="font-headline-sm text-[15px] text-on-surface mb-space-md">Shop</h4>
                <ul class="space-y-space-sm font-body-sm text-body-sm text-on-surface-variant">
                    <li><a class="hover:text-on-surface transition-colors" href="#">Latest Products</a></li>
                    <li><a class="hover:text-on-surface transition-colors" href="#">Best Sellers</a></li>
                    <li><a class="hover:text-on-surface transition-colors" href="#">Special Offers</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-headline-sm text-[15px] text-on-surface mb-space-md">Support</h4>
                <ul class="space-y-space-sm font-body-sm text-body-sm text-on-surface-variant">
                    <li><a class="hover:text-on-surface transition-colors" href="#">Help Center</a></li>
                    <li><a class="hover:text-on-surface transition-colors" href="#">Order Status</a></li>
                    <li><a class="hover:text-on-surface transition-colors" href="#">Returns &amp; Exchanges</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-headline-sm text-[15px] text-on-surface mb-space-md">Company</h4>
                <ul class="space-y-space-sm font-body-sm text-body-sm text-on-surface-variant">
                    <li><a class="hover:text-on-surface transition-colors" href="#">About Us</a></li>
                    <li><a class="hover:text-on-surface transition-colors" href="#">Careers</a></li>
                    <li><a class="hover:text-on-surface transition-colors" href="#">Sustainability</a></li>
                </ul>
            </div>
        </div>
        <div class="pt-space-lg flex flex-col md:flex-row items-center justify-between gap-space-md font-body-sm text-body-sm text-on-surface-variant border-t border-surface-container">
            <p>© {{ date('Y') }} TechStore Inc. All rights reserved.</p>
            <div class="flex items-center gap-space-lg">
                <a class="hover:text-on-surface transition-colors" href="#">Privacy Policy</a>
                <a class="hover:text-on-surface transition-colors" href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
