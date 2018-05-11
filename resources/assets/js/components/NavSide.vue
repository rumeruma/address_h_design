<template>
	
        <nav class="menu">
          <p class="menu-label">
            General
          </p>
          <ul class="menu-list">
            <li><a class="is-active" href="#"><span class="icon is-small"><i class="fa fa-tachometer"></i></span> Dashboard</a></li>
          </ul>
          <p class="menu-label">
            Administration
          </p>
          <ul class="menu-list">
            
            <li>
              <a class=""><i class="fa fa-user"></i> Users </a>
              <ul>
                <router-link to="/360admin/users">All User</router-link>
                <router-link to="/360admin/users/add-new">Add New</router-link>
              </ul>
            </li>
          </ul>
          <p class="menu-label">
            Live On
          </p>
          <!-- <ul class="menu-list">
            <li><a><span class="icon is-small"><i class="fa fa-bug"></i></span> Additional Pages</a></li>
            <li><a><span class="icon is-small"><i class="fa fa-windows"></i></span> Extras</a></li>
            <li><a><span class="icon is-small"><i class="fa fa-laptop"></i></span> Landing Page</a></li>
          </ul> -->
        </nav>
     
</template>