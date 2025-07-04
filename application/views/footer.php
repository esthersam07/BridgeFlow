<style>
.custom-footer {
  background-color: #002c84; /* Deep blue */
  color: white;
  text-align: center;
  padding: 40px 20px;
  position: relative;
  font-family: 'Segoe UI', sans-serif;
}

/* Newsletter Button */
.connect {
  background-color: #a32035; /* Deep red */
  color: white;
  border: none;
  padding: 10px 10px;
  font-size: 16px;
  letter-spacing: 2px;
  margin-bottom: 20px;
  width: 200px;
  height: 50px;
  margin-left: 510px;
}

/* Social Media Icons */
.social-icons {
  margin-bottom: 25px;
}

.social-icons a {
  margin: 0 10px;
  display: inline-block;
}

.social-icons img {
  width: 32px;
  height: 32px;
  filter: brightness(0) invert(1); /* make icons white if black svg/png */
  transition: transform 0.3s;
}

.social-icons a:hover img {
  transform: scale(1.1);
}

/* Footer Navigation Links */
.footer-nav {
  list-style: none;
  padding: 0;
  margin: 0 auto;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 30px;
  margin-top: 20px;
}

.footer-nav li a {
  text-decoration: none;
  color: white;
  font-size: 14px;
  letter-spacing: 1px;
}

.footer-nav li a:hover {
  color: #FFD700;
}

.scroll-top {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background-color: #a32035;
  color: white;
  text-align: center;
  padding: 10px 12px;
  border-radius: 50%;
  font-size: 12px;
  line-height: 16px;
  font-weight: bold;
  text-decoration: none;
  width: 50px;
  height: 50px;
  transition: background-color 0.3s, opacity 0.3s;
  opacity: 0;
  pointer-events: none;
  z-index: 999;
}

.scroll-top.visible {
  opacity: 1;
  pointer-events: auto;
}


</style>
<footer class="custom-footer">
  <div class="connect">
    <p>CONNECT WITH US</p>
  </div>

  <div class="social-icons">
    <a href="https://www.linkedin.com/in/mpsedc/"><img src="\ciStudent\assets\images\linkedin.svg" alt="LinkedIn"></a>
    <a href="https://www.instagram.com/mpsedc_dst/"><img src="\ciStudent\assets\images\insta.svg" alt="Instagram"></a>
    <a href="https://twitter.com/MPSeDC_DST"><img src="\ciStudent\assets\images\telegram.svg" alt="Telegram"></a>
    <a href="https://twitter.com/MPSeDC_DST"><img src="\ciStudent\assets\images\f.svg" alt="Facebook"></a>
        <a href="https://twitter.com/MPSeDC_DST"><img src="\ciStudent\assets\images\x.svg" alt="X"></a>
</div>

  <ul class="footer-nav">
    <li><a href="https://mpsedc.mp.gov.in/COE_Page.aspx#">CAREERS</a></li>
    <li><a href="https://mpsedc.mp.gov.in/contents.aspx?page=copyright-policy&number=YVHeMrzNmfaJgOJiD8fqhg==">COPYRIGHT POLICY</a></li>
    <li><a href="https://mpsedc.mp.gov.in/contents.aspx?page=terms-and-conditions&number=+1NXpDZBlcH8lSkwGYCQ/Q==">TERMS AND CONDITIONS</a></li>
    <li><a href="https://mpsedc.mp.gov.in/websitefeedback.aspx?number=9FWtG7+5hDLwAY36ra6GeQ==">FEEDBACK</a></li>
    <li><a href="https://maps.app.goo.gl/9sqQCJmLKoJNHiwv7">LOCATION</a></li>
  </ul>

  <a href="#top" class="scroll-top">↑<br>TOP</a>
</footer>
<script>
  window.addEventListener('scroll', function () {
    const scrollBtn = document.querySelector('.scroll-top');
    if (window.scrollY > 300) {
      scrollBtn.classList.add('visible');
    } else {
      scrollBtn.classList.remove('visible');
    }
  });
</script>

