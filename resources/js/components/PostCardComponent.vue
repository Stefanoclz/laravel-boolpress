<template>
  <div class="d-flex mb-5 border border-success">
    <div class="mr-4">
      <img :src="'storage/' + cover" :alt="title" />
    </div>
    <div class="middle text-center">
      <h2>{{ title }}</h2>
      <hr />
      <p>{{ content }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostCardComponent",
  props: ["title", "cover", "content"],
  computed: {
    trimmedContent() {
      const shortContent =
        this.content.length > 20 ? this.content.substring(0, 20) : this.content;

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
