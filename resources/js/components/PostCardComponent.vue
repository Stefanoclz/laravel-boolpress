<template>
  <div class="d-flex">
    <div>
      <img :src="'storage/' + cover" :alt="title" />
    </div>
    <div class="middle">
      <div>{{ title }}</div>
      <div>{{ content }}</div>
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
  max-width: 200px;
}

.middle {
  align-self: center;
}
</style>
