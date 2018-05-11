<template>
    <div>
        <div v-for="(image, index) in images">

            <input class="form-control" type="text" v-model="images.src">
            <!--<lfm></lfm>-->
            {{ images.src }}
            <a class="btn btn-primary btn-sm" v-on:click="removeElement(index);" style="cursor: pointer">Remove</a>
        </div>
        <button class="btn btn-sm btn-info" v-on:click="addItem($event)">Add Images</button>
        <a  data-input="thumbnail" data-preview="holder" class="btn btn-primary btn-sm lfm">
            <i class="fa fa-picture-o"></i> Choose
        </a>
        <input id="buckurl" class="form-control" type="text" v-model="fuckingmanager">
        <!--<img id="vodaholder" style="margin-top:15px;max-height:100px;">-->
        {{ balls }} {{ fuckingmanager }}
    </div>
</template>

<script>

    // import Lfm from '../company/FileManager.vue';

    export default {
        data() {
            return {
                images: [],
                lastLimit: 2,
                fuckingmanager: false;
            }
        },
        // components: { Lfm },
        methods:{
            addItem: function(event) {

                this.getUrl();
                if(event) event.preventDefault()


                var elem = document.createElement('tr');
                if (this.images.length <= this.lastLimit) {

                    this.images.push({
                        src: $('#buckurl').val(),
                    });

                    console.log(this.images.src);


                } else {
                    this.$toasted.show('Sorry Maximum Image limit is '+this.lastLimit, {
                        'position':'top-center',
                        'action' :{
                            text : 'close',
                            onClick : (e, toastObject) => {
                            toastObject.goAway(0);
                }
                }
                })
                }



            },
            getUrl:function(){
                var type = 'image';
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                window.SetUrl = function (url, file_path) {
                    var target_input = $('#' + localStorage.getItem('target_input'));
                    $('#buckurl').val(file_path).trigger('change');
                    //$('#vodaholder').attr('src', url).trigger('change');

                };

                console.log(this.fuckingmanager);

            },

            removeElement: function(index) {
                this.images.splice(index, 1);
            }
        },
        computed:{
          balls(){
              return this.$store.state.balls;
          }
        },
        created:function(){

        },
        mounted(){
            // var vm = this
            this.$nextTick(()=>{
                // $('.lfm').filemanager('image')
        });

        },
        watch:{

        }
    }
</script>