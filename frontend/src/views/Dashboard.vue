<template>
<div>
    <main class="container">
      <div v-if="this.user != null">Hi, {{this.user.name}}</div>
      <div v-if="msg != ''" class="alert alert-success" role="alert">{{msg}}</div>
      <form class="navbar-form navbar-left" role="search" style="margin-top:25px">
  <div class="form-group">
    <input type="text" v-model="newPost" class="form-control" placeholder="Create a Post">
  </div>
  <button type="submit"   @click.prevent="createNewPost" class="btn btn-success">Post</button>
</form>

        <div class="my-3 p-3 bg-body rounded shadow-sm" v-for="post in posts" :key="post.id" >
            <h6 class="border-bottom pb-2 mb-0">{{post.post.question}}</h6>
            <div class="d-flex text-muted pt-3" v-for="comment in post.comments" :key="comment.id">
                <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>

                <p class="pb-3 mb-0 small lh-sm border-bottom">
                    <strong class="d-block text-gray-dark">@username</strong> {{comment.comment}}
                </p>
            </div>
            
          
            <small class="d-block text-end mt-3">
        <div class="input-group mb-3">
          <input type="text" v-model="comment" class="form-control" placeholder="Add your comment here..." >
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" @click.prevent="addComment(post.post.id)" type="button">Submit</button>
          </div>
        </div>
     
      <a v-if="post.post.user_id == user.id || user.id == 1" href="#" style="color:red" @click="deleteMyPost(post.post.id)" > | delete</a>
      <span v-if="post.post.status != 'approve'"><a v-if="user.id == 1 && post.post.status == 'pending'" href="#" style="color:green" @click.prevent="approvePost(post.post.id)" > | Approve</a></span>
      <a v-if="user.id == 1" href="#" style="color:black" @click.prevent="rejectPost(post.post.id)" > | Reject</a>
    </small>
        </div>

    </main>
    </div>
</template>

<script>
import User from "../apis/User";
import Post from "../apis/Post";

export default {
  data() {
    return {
      user: null,
      posts: null,
      newPost:"",
      msg:"",
      comment:""
    };
  },

  mounted() {
    User.auth().then(response => {
      this.user = response.data;
    });

    Post.all().then(response => {
      console.log(response.data.data);
      this.posts = response.data.data;
    }); 
    
  },

  methods: {
    createNewPost() {
      Post.add(this.newPost)
       .then(() => {
          this.msg = 'Success!';
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
    deleteMyPost(id) {
      Post.deletepost(id)
        .then(() => {
            this.msg = 'Deleted!';
           this.refreshPost()
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
    approvePost(id) {
      Post.approvepost(id)
       .then(() => {
            this.msg = 'Approved!';
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
    rejectPost(id) {
      Post.rejectpost(id)
       .then(() => {
            this.msg = 'Rejected!';
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
    addComment(id) {
      Post.addcomment(id,this.comment)
       .then(() => {
            this.msg = 'Comment added!';
            this.refreshPost();
            this.comment = "";
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
    refreshPost() {
       Post.all().then(response => {
            this.posts = response.data.data
            }); 
    },
  }
};
</script>

