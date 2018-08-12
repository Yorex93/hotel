<template>
  <div>
    <v-layout row wrap>
      <v-flex sm12>
        <vue-dropzone
                style="width: 100%"
                class="mb-4 mt-3"
                v-if="ready && allowUpload"
                ref="myDropzone"
                id="dropzone"
                :options="dropZoneOptions"
                v-on:vdropzone-file-added="fileAdded($event)"
                v-on:vdropzone-success-multiple="uploadSuccessful($event)"
        >
        </vue-dropzone>
      </v-flex>
      <v-flex sm12>
        <v-btn color="green" @click.prevent="upload">Upload</v-btn>
        <v-btn color="info" @click.prevent="toggleSelectMode">Turn {{ selectMode ? 'off' : 'on' }} multi select</v-btn>
        <v-btn color="error"
               v-if="allowDelete"
                @click.prevent="confirmDelete"
               :disabled="selected.length === 0"
        >
          Delete Selected ({{ selected.length }})</v-btn>
      </v-flex>
    </v-layout>
    <v-layout row wrap>
      <v-flex xs12 sm3 md3 v-for="file of media" :key="file.id" class="media-list-image">
        <div class="inner-wrapper">
          <div class="select-mask" v-if="selectMode" @click="toggleSelected(file.id)" :class="{ 'selected': selected.includes(file.id) }"></div>
          <img v-if="isImage(file)" v-img="{ group: 'images' }" :src="getImageUrl(file.file)" style="width: 100%"/>
        </div>
      </v-flex>
    </v-layout>

    <v-dialog
            v-model="deleteDialog"
            max-width="290"
    >
      <v-card>
        <v-card-title class="headline">Delete {{ selected.length }} items?</v-card-title>

        <v-card-text>
          This action is irreversible
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
              color="blue darken-1"
              flat="flat"
              @click="deleteDialog = false"
          >
            Cancel
          </v-btn>

          <v-btn
              color="red darken-1"
              flat="flat"
              @click="deleteSelected"
          >
            Delete
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="isDeletingFiles"
      hide-overlay
      persistent
      width="300"
    >
      <v-card
          color="blue"
          dark
      >
        <v-card-text>
          Deleting {{ selected.length }} files
          <v-progress-linear
              indeterminate
              color="white"
              class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    import { fileResolvers, urlResolvers } from '../../services/helpers';
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css';
    import { deleteMedia } from '../../services/file-service';
    export default {
        name: 'MediaList',
        components: {
            vueDropzone: vue2Dropzone
        },
        props: {
            'media': { type: Array, required: true },
            'allowUpload': { type: Boolean, default: false },
            'allowDelete': { type: Boolean, default: false },
            'maxAllowedUpload': { type: Number, default: 5 },
            'uploadLink': { type: String, default: '#' }
        },

        data: () => ({
            ready: false,
            selectMode: false,
            selected: [],
            deleteDialog: false,
            isDeletingFiles: false,
            dropZoneOptions: {
                url: this.uploadLink,
                autoProcessQueue: false,
                thumbnailWidth: 240,
                addRemoveLinks: true,
                paramName: 'files',
                uploadMultiple: true,
                headers: {
                    "Accepts" : 'application/json',
                    "Authorization" : 'Bearer '+localStorage.getItem('token')
                }
            }
        }),

        validations: {},

        methods: {
            // ...mapActions(''),
            isImage(data){
                return fileResolvers.isImage(data);
            },
            getImageUrl(data){
                return urlResolvers.getImage(data);
            },
            fileAdded($event){
                console.log($event);
            },

            upload(){
                console.log(this.$refs);
                this.$refs.myDropzone.processQueue();
            },

            uploadSuccessful(files, response){
                console.log(response);
                console.log(files);
                this.$refs.myDropzone.removeAllFiles();
                this.$emit('media-uploaded', files);
            },

            toggleSelected(id){
                if(this.selected.includes(id)){
                    this.selected = this.selected.filter(i => i !== id);
                } else {
                    this.selected.push(id);
                }
            },

            toggleSelectMode(){
                this.selectMode = !this.selectMode;
            },

            deleteSelected(){
              this.deleteDialog = false;
              this.isDeletingFiles = true;

              deleteMedia(this.selected).then((resp) => {
                  this.$emit('media-deleted');
                  this.selected = [];
                  this.selectMode = false;
                  this.$toastr.s("Files deleted successfully!!");
              }).catch(error => {
                  this.$toastr.e("Error occurred while deleting files");
              }).finally(() => {
                  this.isDeletingFiles = false;
              });
            },

            confirmDelete(){
                this.deleteDialog = true;
            }
        },

        computed: {
            // ...mapGetters('', []),
        },

        created() {},

        watch: {
            uploadLink(value){
                this.dropZoneOptions.url = value;
                this.ready = true;
            },
        },

        beforeRouteLeave(to, from, next){
            next();
        }

    }
</script>

<style lang="scss">

  .media-list-image{
    padding: 25px;
    
    .inner-wrapper{
      position: relative;
      height: 100%;
    }
  }

  .select-mask{
    transition: 0.3s all ease-in-out;
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    background: rgba(20, 74, 74, 0.6);
    cursor: pointer;

    &.selected{
      border: 8px solid #2fffa9;
    }
  }
</style>