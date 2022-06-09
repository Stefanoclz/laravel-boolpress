<template>
  <div class="container">
    <div class="row">
      <div class="col-12">MY POSTS</div>

      <div>
        <PostCardListComponent :posts="posts" />
      </div>
    </div>
  </div>
</template>

<script>
import PostCardListComponent from "../components/PostCardListComponent";

export default {
  name: "BlogComponent",
  components: { PostCardListComponent },
  data() {
    return {
      posts: [],
    };
  },
  mounted() {
    window.axios
      .get("http://127.0.0.1:8000/api/posts")
      .then(({ status, data }) => {
        console.log(data);
        if (status === 200 && data.success) {
          this.posts = data.results.data;
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
