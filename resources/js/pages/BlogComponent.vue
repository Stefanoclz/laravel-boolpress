<template>
  <div class="container">
    <div class="row">
      <h1 class="col-12 text-center">MY POSTS</h1>

      <div v-if="posts.length > 0">
        <PostCardListComponent :posts="posts" />
        <div class="pagination">
          <button
            v-if="previousPageLink"
            @click="goPreviousPage()"
            class="mr-3"
          >
            Prev
          </button>

          {{ currentPage }}/{{ lastPage }}

          <button v-if="nextPageLink" @click="goNextPage()" class="ml-3">
            Next
          </button>
        </div>
      </div>
      <div v-else>Caricamento in corso</div>
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
      currentPage: 1,
      previousPageLink: "",
      nextPageLink: "",
      lastPage: 1,
    };
  },
  mounted() {
    this.loadPage("http://127.0.0.1:8000/api/posts");
  },
  methods: {
    loadPage(url) {
      window.axios
        .get(url)
        .then(({ status, data }) => {
          console.log(data);
          if (status === 200 && data.success) {
            this.posts = data.results.data;
            this.currentPage = data.results.current_page;
            this.previousPageLink = data.results.prev_page_url;
            this.nextPageLink = data.results.next_page_url;
            this.lastPage = data.results.last_page;
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    goPreviousPage() {
      this.loadPage(this.previousPageLink);
    },
    goNextPage() {
      this.loadPage(this.nextPageLink);
    },
  },
};
</script>

<style lang="scss" scoped>
.pagination {
  width: 20%;
  margin: 50px auto;
}

img {
  max-width: 500px;
}
</style>
