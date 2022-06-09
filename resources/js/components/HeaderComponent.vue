<template>
  <header>
    <nav class="navbar navbar-light bg-white">
      <ul class="nav">
        <li
          class="nav-item mr-5"
          v-for="(menuItem, index) in menu"
          :key="index"
        >
          <router-link :to="{ name: menuItem.linkName }">{{
            menuItem.label
          }}</router-link>
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
export default {
  name: "HeaderComponent",
  data() {
    return {
      menu: [
        { linkName: "home", label: "Home" },
        { linkName: "blog", label: "My posts" },
        { linkName: "who-we-are", label: "Who we are" },
        { linkName: "contacts", label: "Contacts" },
      ],
    };
  },
};
</script>

<style>
</style>
