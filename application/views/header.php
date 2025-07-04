<style>
.custom-header {
  background-color: #002c84;
  color: white;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 30px;
  font-family: 'Segoe UI', sans-serif;
  position: fixed;
  width: 100%;
  top: 0;
  z-index: 1000;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  height: 80px; /* ADD THIS */
  box-sizing: border-box;
}
.header-left img {
  height: 100px; /* REDUCE logo height */
  width: auto;
  max-width: 200px; /* optional: prevents wide logos */
}

.header-left {
  flex-shrink: 0;
}

.header-nav ul {
  list-style: none;
  display: flex;
  gap: 30px;
  margin: 0;
  padding: 0;
  flex-wrap: wrap; /* prevent overflow */
}


.header-nav a {
  text-decoration: none;
  color: white;
  font-weight: 500;
  letter-spacing: 1px;
  font-size: 14px;
  transition: color 0.3s;
}

.header-nav a:hover {
  color: #FFD700; 
}

</style>
<header class="custom-header">
  <div class="header-left">
    <img src="\ciStudent\assets\images\logo.jpg" alt="Logo">
  </div>
  <nav class="header-nav">
    <ul>
      <?php if($this->session->userdata('logged_in')===TRUE){?>
        <li><a href="<?php echo base_url('auth/userProfile'); ?>">Home</a></li>
      <?php }else { ?>
        <li><a href="<?php echo base_url('home'); ?>">Home</a></li>
      <?php } ?>


      <?php if($this->session->userdata('logged_in')===TRUE){?>
        <li><a href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
      <?php }else { ?>
        <li><a href="<?php echo base_url('login'); ?>">Login</a></li>
      <?php } ?>
    </ul>
  </nav>
</header>
