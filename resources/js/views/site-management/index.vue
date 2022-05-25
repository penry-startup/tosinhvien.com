<template>
  <div class="page-target">
    <table-panel>
      <template slot="title">
        <small class="text--uppercase">{{ $t('table.title.site_management') }}</small>
      </template>

      <template slot="buttons">
        <el-button class="btn-refresh" :class="{ 'refreshing': isRefresh }" size="mini" @click="onRefresh">
          <svg-icon icon-class="refresh" />
        </el-button>
      </template>

      <template slot="table">
        <el-form ref="formSiteManagement" :loading="true" :model="form" :rules="formRules" label-position="top">
          <div class="heading">{{ $t('title.general_settings') }}</div>
          <!-- Brand Name Input -->
          <el-form-item :label="$t('form.field.brand_name')" prop="brand_name" :error="getErrorForField('brand_name', errorsServer)" required>
            <el-input v-model="form.brand_name" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.brand_name') })" />
          </el-form-item>

          <!-- Greeting Input -->
          <el-form-item :label="$t('form.field.greeting')" prop="greeting" :error="getErrorForField('greeting', errorsServer)" required>
            <el-input v-model="form.greeting" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.greeting') })" />
          </el-form-item>

          <!-- Global Notification Input -->
          <el-form-item :label="$t('form.field.global_notification')" :error="getErrorForField('global_notification', errorsServer)" prop="global_notification">
            <Tinymce
              ref="global_notification"
              v-model="form.global_notification"
              menubar=""
              :has-upload="false"
              :toolbar="['bold italic underline alignleft aligncenter alignright undo redo codesample hr bullist numlist link preview pagebreak forecolor backcolor fullscreen']"
              :height="200"
            />
            <el-input v-model="form.global_notification" class="d-none" />
          </el-form-item>

          <!-- Top Slogan Input -->
          <el-form-item :label="$t('form.field.top_slogan')" prop="top_slogan" :error="getErrorForField('top_slogan', errorsServer)" required>
            <el-input v-model="form.top_slogan" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.top_slogan') })" />
          </el-form-item>

          <!-- Sub Top Slogan Input -->
          <el-form-item :label="$t('form.field.sub_top_slogan')" prop="sub_top_slogan" :error="getErrorForField('sub_top_slogan', errorsServer)" required>
            <el-input v-model="form.sub_top_slogan" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.sub_top_slogan') })" />
          </el-form-item>

          <!-- Maintenance Mode Input -->
          <el-form-item :label="$t('form.field.maintenance_mode')" prop="maintenance_mode" :error="getErrorForField('sub_top_slogan', errorsServer)" required>
            <el-switch
              v-model="form.maintenance_mode"
              active-color="#13ce66"
              inactive-color="#ff4949"
              :active-value="1"
              :inactive-value="0"
            />
          </el-form-item>

          <!-- Brand Logo Image -->
          <el-form-item
            :label="$t('form.field.brand_logo')"
            prop="logo_image"
          >
            <pan-thumb
              :image="form.logo_image"
              :show-icon="true"
              @click="images.logo.cropperShow = true"
              @clear="onClearImage('logo')"
            />
            <image-cropper
              v-show="images.logo.cropperShow"
              :key="images.logo.key"
              :width="436"
              :height="193"
              :source-img-url="form.logo_image"
              lang-type="vi"
              @close="images.logo.cropperShow = false"
              @crop-upload-success="file => onCropSuccessImage(file, 'logo')"
            />
          </el-form-item>

          <!-- Favicon Image -->
          <el-form-item
            :label="$t('form.field.favicon')"
            prop="favicon_image"
          >
            <pan-thumb
              :image="form.favicon_image"
              :show-icon="true"
              @click="images.favicon.cropperShow = true"
              @clear="onClearImage('favicon')"
            />
            <image-cropper
              v-show="images.favicon.cropperShow"
              :key="images.favicon.key"
              :width="50"
              :height="50"
              :source-img-url="form.favicon_image"
              lang-type="vi"
              @close="images.favicon.cropperShow = false"
              @crop-upload-success="file => onCropSuccessImage(file, 'favicon')"
            />
          </el-form-item>

          <!-- Banner Image -->
          <el-form-item
            :label="$t('form.field.banner')"
            prop="banner_image"
          >
            <pan-thumb
              :image="form.banner_image"
              :show-icon="true"
              @click="images.banner.cropperShow = true"
              @clear="onClearImage('banner')"
            />
            <image-cropper
              v-show="images.banner.cropperShow"
              :key="images.banner.key"
              :width="1425"
              :height="436"
              :source-img-url="form.banner_image"
              lang-type="vi"
              @close="images.banner.cropperShow = false"
              @crop-upload-success="file => onCropSuccessImage(file, 'banner')"
            />
          </el-form-item>

          <div class="heading">{{ $t('title.support_settings') }}</div>
          <!-- Support phone Input -->
          <el-form-item :label="$t('form.field.support_phone')" prop="support_phone" :error="getErrorForField('support_phone', errorsServer)" required>
            <el-input v-model="form.support_phone" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.support_phone') })" />
          </el-form-item>

          <!-- Support email Input -->
          <el-form-item :label="$t('form.field.support_email')" prop="support_email" :error="getErrorForField('support_email', errorsServer)" required>
            <el-input v-model="form.support_email" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.support_email') })" />
          </el-form-item>

          <!-- Default Sender Email Address Input -->
          <el-form-item :label="$t('form.field.default_sender_email_address')" prop="default_sender_email_address" :error="getErrorForField('default_sender_email_address', errorsServer)" required>
            <el-input v-model="form.default_sender_email_address" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.default_sender_email_address') })" />
          </el-form-item>

          <!-- Default Email Sender Name Input -->
          <el-form-item :label="$t('form.field.default_email_sender_name')" prop="default_email_sender_name" :error="getErrorForField('default_email_sender_name', errorsServer)" required>
            <el-input v-model="form.default_email_sender_name" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.default_email_sender_name') })" />
          </el-form-item>

          <div class="heading">{{ $t('title.social_settings') }}</div>

          <!-- Facebook Link Input -->
          <el-form-item :label="$t('form.field.facebook_link')" prop="facebook_link" :error="getErrorForField('facebook_link', errorsServer)">
            <el-input v-model="form.facebook_link" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.facebook_link') })" />
          </el-form-item>

          <!-- Facebook Fanpage Link Input -->
          <el-form-item :label="$t('form.field.facebook_fanpage_link')" prop="facebook_fanpage_link" :error="getErrorForField('facebook_fanpage_link', errorsServer)">
            <el-input v-model="form.facebook_fanpage_link" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.facebook_fanpage_link') })" />
          </el-form-item>

          <!-- Zalo Phone Input -->
          <el-form-item :label="$t('form.field.zalo_phone')" prop="zalo_phone" :error="getErrorForField('zalo_phone', errorsServer)">
            <el-input v-model="form.zalo_phone" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.zalo_phone') })" />
          </el-form-item>

          <!-- Zalo Group Link Input -->
          <el-form-item :label="$t('form.field.zalo_group_link')" prop="zalo_group_link" :error="getErrorForField('zalo_group_link', errorsServer)">
            <el-input v-model="form.zalo_group_link" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.zalo_group_link') })" />
          </el-form-item>

          <!-- Instagram Link Input -->
          <el-form-item :label="$t('form.field.instagram_link')" prop="instagram_link" :error="getErrorForField('instagram_link', errorsServer)">
            <el-input v-model="form.instagram_link" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.instagram_link') })" />
          </el-form-item>

          <!-- Youtube Link Input -->
          <el-form-item :label="$t('form.field.youtube_link')" prop="youtube_link" :error="getErrorForField('youtube_link', errorsServer)">
            <el-input v-model="form.youtube_link" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.youtube_link') })" />
          </el-form-item>

          <div class="heading">{{ $t('title.meta_settings') }}</div>

          <!-- Meta Title Input -->
          <el-form-item :label="$t('form.field.meta_title')" prop="meta_title" :error="getErrorForField('meta_title', errorsServer)" required>
            <el-input v-model="form.meta_title" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.meta_title') })" />
          </el-form-item>

          <!-- Meta Description Input -->
          <el-form-item :label="$t('form.field.meta_description')" prop="meta_description" :error="getErrorForField('meta_description', errorsServer)" required>
            <el-input v-model="form.meta_description" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.meta_description') })" />
          </el-form-item>

          <!-- Meta Keywords Input -->
          <el-form-item :label="$t('form.field.meta_keywords')" prop="meta_keywords" :error="getErrorForField('meta_keywords', errorsServer)" required>
            <el-input v-model="form.meta_keywords" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.meta_keywords') })" />
          </el-form-item>

          <!-- Meta Type Input -->
          <el-form-item :label="$t('form.field.meta_type')" prop="meta_type" :error="getErrorForField('meta_type', errorsServer)" required>
            <el-input v-model="form.meta_type" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.meta_type') })" />
          </el-form-item>

          <!-- Meta Locale Input -->
          <el-form-item :label="$t('form.field.meta_locale')" prop="meta_locale" :error="getErrorForField('meta_locale', errorsServer)" required>
            <el-input v-model="form.meta_locale" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.meta_locale') })" />
          </el-form-item>

          <!-- Meta Author Input -->
          <el-form-item :label="$t('form.field.meta_author')" prop="meta_author" :error="getErrorForField('meta_author', errorsServer)" required>
            <el-input v-model="form.meta_author" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.meta_author') })" />
          </el-form-item>

          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formSiteManagement')"
            >
              {{ $t('button.update') }}
            </el-button>
          </el-form-item>
        </el-form>
      </template>
    </table-panel>
  </div>
</template>

<script>
import TablePanel from '@/components/TablePanel';
import PanThumb from '@/components/PanThumb';
import ImageCropper from '@/components/ImageCropper';
import SiteManagementResource from '@/http/api/v1/site-management';
import formValidate from './helpers/form-validate';
const siteManagementResource = new SiteManagementResource();
import Tinymce from '@/components/Tinymce';

const defaultForm = {
  brand_name: '',
  logo_image: '',
  favicon_image: '',
  banner_image: '',
  greeting: '',
  global_notification: '',
  top_slogan: '',
  sub_top_slogan: '',
  maintenance_mode: '',
  support_phone: '',
  support_email: '',
  default_sender_email_address: '',
  default_email_sender_name: '',
  facebook_link: '',
  facebook_fanpage_link: '',
  zalo_phone: '',
  zalo_group_link: '',
  instagram_link: '',
  youtube_link: '',
  meta_title: '',
  meta_description: '',
  meta_keywords: '',
  meta_type: '',
  meta_locale: '',
  meta_author: '',
};

export default {
  name: 'SiteManagementIndex',
  components: {
    TablePanel,
    PanThumb,
    ImageCropper,
    Tinymce,
  },
  layout: 'admin',
  middleware: 'auth',
  data: () => ({
    activeName: 'general_setting',
    form: Object.assign({}, defaultForm),
    errorsServer: [],
    loading: false,
    isRefresh: false,
    formData: new FormData(),
    images: {
      logo: {
        cropperShow: false,
        key: 0,
      },
      favicon: {
        cropperShow: false,
        key: 0,
      },
      banner: {
        cropperShow: false,
        key: 0,
      },
    },
  }),
  computed: {
    formRules() {
      return {
        ...formValidate(this),
      };
    },
  },
  created() {
    this.getDetail();
  },
  methods: {
    getDetail() {
      siteManagementResource.show()
        .then(({ data: { data }}) => {
          this.form = data;
          this.isRefresh = false;
          this.loading = false;
        })
        .catch(() => {
          this.isRefresh = false;
          this.loading = false;
        });
    },
    update(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.errorsServer = [];
          this.appendToFormData();
          siteManagementResource.update(this.formData)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.site_management')).toLowerCase(),
                }),
                type: 'success',
              });
              this.loading = false;
              this.resetRoute();
              this.$emit('success');
            })
            .catch(({ response }) => {
              if (response && response.data) {
                this.pushErrorFromServer(response.data);
              }
              this.loading = false;
            });
        }
      });
    },
    appendToFormData() {
      this.formData.set('brand_name', this.form.brand_name);
      this.formData.set('greeting', this.form.greeting);
      this.formData.set('global_notification', this.form.global_notification);
      this.formData.set('top_slogan', this.form.top_slogan);
      this.formData.set('sub_top_slogan', this.form.sub_top_slogan);
      this.formData.set('maintenance_mode', this.form.maintenance_mode);
      this.formData.set('support_phone', this.form.support_phone);
      this.formData.set('support_email', this.form.support_email);
      this.formData.set('default_sender_email_address', this.form.default_sender_email_address);
      this.formData.set('default_email_sender_name', this.form.default_email_sender_name);
      this.formData.set('facebook_link', this.form.facebook_link);
      this.formData.set('facebook_fanpage_link', this.form.facebook_fanpage_link);
      this.formData.set('zalo_phone', this.form.zalo_phone);
      this.formData.set('zalo_group_link', this.form.zalo_group_link);
      this.formData.set('instagram_link', this.form.instagram_link);
      this.formData.set('youtube_link', this.form.youtube_link);
      this.formData.set('meta_title', this.form.meta_title);
      this.formData.set('meta_description', this.form.meta_description);
      this.formData.set('meta_keywords', this.form.meta_keywords);
      this.formData.set('meta_type', this.form.meta_type);
      this.formData.set('meta_locale', this.form.meta_locale);
      this.formData.set('meta_author', this.form.meta_author);
    },
    onRefresh() {
      this.isRefresh = true;
      this.getDetail();
    },
    pushErrorFromServer({ message, errors }) {
      this.$message({
        showClose: true,
        message: message,
        type: 'error',
      });
      if (errors && !this.errorsServer.length) {
        for (const [key, value] of Object.entries(errors)) {
          this.errorsServer.push({ key, value });
        }
      }
    },
    getErrorForField(field, errors) {
      if (!errors && !errors.length) {
        return false;
      }
      const filtered = errors.filter(error => {
        return error.key === field;
      });
      if (filtered.length) {
        return filtered[0].value;
      }
    },
    onClearImage(type) {
      this.images[type].cropperShow = false;
      this.form[`${type}_image`] = '';
    },
    onCropSuccessImage(file, type) {
      console.log(`images[${type}]`);
      this.formData.set(`images[${type}]`, file.file, file.name);
      this.form[`${type}_image`] = URL.createObjectURL(file.file);
      this.images[type].cropperShow = false;
      this.images[type].key += 1;
    },
  },
};
</script>

<style scoped>
.heading {
  color: #fff;
  padding: 5px 10px;
  background-color: #2f83ff;
  border-radius: 3px;
  margin-bottom: 10px;
}
</style>
