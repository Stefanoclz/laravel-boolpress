<template>
  <div class="d-flex mb-5 border border-success">
    <div class="mr-4">
      <img :src="'storage/' + cover" :alt="title" />
    </div>
    <div class="middle text-center px-5">
      <h2>{{ title }}</h2>
      <hr />
      <p>{{ trimmedContent }}...<i>(continua)</i></p>
    </div>
    <router-link :to="{ name: 'single-blog', params: { id } }"
      >Visualizza</router-link
    >
  </div>
</template>

<script>
export default {
  name: "PostCardComponent",
  props: ["title", "cover", "content", "id"],
  computed: {
    trimmedContent() {
      const shortContent =
        this.content.length > 20 ? this.content.substring(0, 80) : this.content;
      return shortContent;
    },
  },
};
</script>

<style lang="scss" scoped>
img {
  max-width: 400px;
}

.middle {
  align-self: center;
}
</style>
