<?php $footer = $landingData['footer']; ?>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-col">
            <h3 class="footer-logo">PeGPeM<span>.</span></h3>
            <p>Sharing insights on technology, lifestyle, and design. Follow our journey as we explore the digital
                world.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Latest Blogs</a></li>
                <li><a href="#editors">Trending Topics</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Categories</h4>
            <ul>
                <?php foreach ($footer as $info): ?>
                <li><a
                        href="?p=more&v=category&category=<?= htmlspecialchars($info['cartegory']) ?>"><?php echo htmlspecialchars($info['cartegory']) ?></a>
                </li>
                <?php endforeach ?>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Newsletter</h4>
            <p>Subscribe to get the latest posts delivered to your inbox.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Your email address" required>
                <button type="submit">Join</button>
            </form>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 Pegpem. All rights reserved.</p>
        <div class="bottom-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </div>
    </div>
</footer>
<script src="./public/js/file.js" type="text/javascript" defer></script>
<script src="./public/js/typewriter.js" type="text/javascript" defer></script>
<script src="./public/js/truncate.js" type="text/javascript" defer></script>
</body>

</html>