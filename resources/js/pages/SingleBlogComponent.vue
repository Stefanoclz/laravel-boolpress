<template>
  <div class="container">
    <div class="row">
      <h1 class="col-12 text-center">MY POSTS</h1>

      <div v-if="post" class="col-12 mb-2">
        <h2>{{ post.title }}</h2>
        <div>
          <img :src="'/storage/' + post.cover" :alt="post.title" />
        </div>
        <p>{{ post.content }}</p>
        <div>
          <h4>Categoria:</h4>
          {{ post.category.name }}
        </div>
        <div>
          <h3>Tags:</h3>
          <ul>
            <li v-for="tag in post.tags" :key="tag.id">
              {{ tag.name }}
            </li>
          </ul>
        </div>
      </div>
      <div v-else>Caricamento in corso</div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SingleBlogComponent",
  data() {
    return {
      post: undefined,
    };
  },
  mounted() {
    const id = this.$route.params.id;
    console.log("mounted with id", id);
    window.axios
      .get("http://127.0.0.1:8000/api/posts" + id)
      .then(({ status, data }) => {
        console.log(data);
        if (status === 200 && data.success) {
          this.post = data.results;
        }
      })
      .catch((e) => {
        console.log(e);
      });
  },
};
</script>

<style>
</style>
