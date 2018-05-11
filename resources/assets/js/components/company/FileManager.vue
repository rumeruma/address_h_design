<template>

    <div>

         <a  data-input="thumbnail" data-preview="holder" class="btn btn-primary btn-sm lfm">
           <i class="fa fa-picture-o"></i> Choose
         </a>
        <input id="thumbnail" class="form-control" type="hidden" value="">
        <img id="holder" style="margin-top:15px;max-height:100px;">

    </div>
</template>

<script>
    export default {
        mounted(){
            // var vm = this
            this.$nextTick(()=>{
                $('.lfm').filemanager('image')
            });

        }
    }
</script>

<style scoped>

</style>