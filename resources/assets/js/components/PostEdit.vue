<template>
  <div>
    <div v-if="edit_id">
      <h4>Edit Post</h4>
    </div>
    <div v-else>
      <h4>New Post</h4>
    </div>
    <div style="margin-top:2em; margin-bottom:2em;">
      <div class="form-group">
        <label>Title</label>
        <input class="form-control" v-model="edit_title" placeholder="title">
      </div>
      <div class="form-group">
        <label>Visible On Date</label>
        <datepicker class="form-control" v-model="edit_visible_at" bootstrap-styling></datepicker>
      </div>
      <div class="form-group">
        <label>Post Body</label>
        <textarea class="form-control" rows="8" cols="55" v-model="edit_body" placeholder="body"></textarea>
      </div>
    </div>
    <button class="btn btn-success btn-sm" v-on:click="save">Save</button>
    <div v-if="state_saved" class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:2em">
      <strong>Post Saved!</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" v-on:click="state_saved=false">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';

export default {
  props: ["id", "title", "body", "visibleAt", "slug", "userId", "apiToken"],

  data: function() {
    return {
      edit_id: this.id,
      edit_title: this.title,
      edit_body: this.body,
      edit_visible_at: new Date(this.visibleAt),
      state_saved: false
    };
  },

  components: {
    Datepicker
  },

  methods: {
    save: function() {
      if (this.id == null) {  
        axios
          .post(
            "/api/posts/",
            {
              title: this.edit_title,
              body: this.edit_body,
              visible_at: this.edit_visible_at.toISOString().split('T')[0]
            },
            {
              headers: {
                Authorization: "Bearer " + this.apiToken
              }
            }
          )
          .then(({ data }) => {
            this.state_saved = true;
            this.edit_id = data.id;
          })
          .catch(error => {
            console.log(error.response);
          });
      } else {
        axios
          .put(
            "/api/posts/" + this.slug,
            {
              title: this.edit_title,
              body: this.edit_body,
              visible_at: this.edit_visible_at.toISOString().split('T')[0]
            },
            {
              headers: {
                Authorization: "Bearer " + this.apiToken
              }
            }
          )
          .then(({ data }) => {
            this.state_saved = true;
          })
          .catch(error => {
            console.log(error.response);
          });
      }
    }
  }
};
</script>