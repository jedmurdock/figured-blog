<template>
  <div>
    
    <h2>{{title}}</h2>
    
    <p>{{body}}</p>
    <div v-if="userId">
      <a class='btn btn-info btn-sm' :href="'/posts/edit/' + slug">edit</a> 
      <button  class='btn btn-danger btn-sm' @click="$emit('delete-post')">delete</button> 
      <em>{{visibleAt}}</em> 
    </div>
    <hr/>
  </div>
</template>

<script>
  export default {
    props: ['title','body','visibleAt','slug', 'userId'],
  }
</script>