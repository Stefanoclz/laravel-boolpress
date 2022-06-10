<template>
  <div class="container">
    <div class="row">
      <h1 class="col-12 text-center">MY POSTS</h1>

      <div v-if="post" class="col-12 mb-2 text-center">
        <h2>{{ post.title }}</h2>
        <div>
          <img :src="'/storage/' + post.cover" :alt="post.title" />
        </div>
        <p>{{ post.content }}</p>
        <div>
          <h4>Categoria:</h4>
          {{ post.category.name }}
        </div>
        <div class="tags">
          <h3>Tags:</h3>
          <ul class="list-group">
            <li v-for="tag in post.tags" :key="tag.id" class="list-group-item">
              {{ tag.name }}
            </li>
          </ul>
        </div>
        <router-link :to="{ name: 'blog' }" class="btn btn-dark"
          >Indietro</router-link
        >
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
    const slug = this.$route.params.slug;
    console.log("mounted with id", slug);
    window.axios
      .get("http://127.0.0.1:8000/api/posts/" + slug)
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

<style lang="scss" scoped>
h2 {
  margin-top: 40px;
}

img {
  max-width: 500px;
  margin: 50px 0px;
  -webkit-box-shadow: 5px 5px 10px 0px #000000;
  -moz-box-shadow: 5px 5px 10px 0px #000000;
  -o-box-shadow: 5px 5px 10px 0px #000000;
  box-shadow: 5px 5px 10px 0px #000000;
}

.tags {
  width: 20%;
  margin: 20px auto;
}
</style>
