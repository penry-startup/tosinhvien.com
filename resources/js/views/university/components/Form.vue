<template>
  <div class="form-dialog">
    <div class="form-dialog__inner">
      <el-dialog
        :title="$t('form.title.form')"
        :visible.sync="dialogVisible"
        :width="dialogSize"
        :before-close="onBeforeClose"
        @close="$emit('close')"
      >
        <el-form ref="formUniversity" :loading="true" :model="form" :rules="formRules" label-position="top">
          <!-- Name Input -->
          <el-form-item :label="$t('form.field.name')" prop="name" :error="getErrorForField('name', errorsServer)" required>
            <el-input v-model="form.name" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.name') })" />
          </el-form-item>

          <!-- Code Input -->
          <el-form-item :label="$t('form.field.code')" prop="code" :error="getErrorForField('code', errorsServer)" required>
            <el-input v-model="form.code" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.code') })" />
          </el-form-item>

          <!-- Type Input -->
          <el-form-item :label="$t('form.field.type')" prop="type" :error="getErrorForField('type', errorsServer)" required>
            <el-select v-model="form.type" :placeholder="$t('form.placeholder.select', { field: $t('form.field.type') })" class="w-100">
              <el-option
                v-for="(typeLabel, typeKey) in univTypeList.label"
                :key="typeKey"
                :label="typeLabel"
                :value="+typeKey"
              />
            </el-select>
          </el-form-item>

          <!-- City Input -->
          <el-form-item :label="$t('form.field.city')" prop="city_id" :error="getErrorForField('city_id', errorsServer)" required>
            <el-select v-model="form.city_id" filterable :placeholder="$t('form.placeholder.select', { field: $t('form.field.city') })" class="w-100">
              <el-option
                v-for="city in listCities"
                :key="city.id"
                :label="city.name"
                :value="+city.id"
              />
            </el-select>
          </el-form-item>

          <!-- Phone Input -->
          <el-form-item :label="$t('form.field.phone')" prop="phone" :error="getErrorForField('phone', errorsServer)">
            <el-input v-model="form.phone" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone') })" />
          </el-form-item>

          <!-- Website Input -->
          <el-form-item :label="$t('form.field.website')" prop="website" :error="getErrorForField('website', errorsServer)">
            <el-input v-model="form.website" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.website') })" />
          </el-form-item>

          <!-- Address Input -->
          <el-form-item :label="$t('form.field.address')" prop="address" :error="getErrorForField('address', errorsServer)">
            <el-input v-model="form.address" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.address') })" />
          </el-form-item>

          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              v-if="!$route.query.edit"
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="store('formUniversity')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formUniversity')"
            >
              {{ $t('button.update') }}
            </el-button>
          </el-form-item>
        </el-form>
      </el-dialog>
    </div>
  </div>
</template>

<script>
import UniversityResource from '@/http/api/v1/university';
import StaticResource from '@/http/api/v1/static';
import { bodyConfig } from '@/utils/helpers';
import { validURL, validPhone } from '@/utils/validate';

const universityResource = new UniversityResource();
const staticResource = new StaticResource();
const defaultForm = {
  name: '',
  code: '',
  city_id: '',
  type: '',
  address: '',
  phone: '',
  website: '',
};

export default {
  name: 'FormUniversity',
  props: {
    isOpened: {
      type: Boolean,
      default: false,
    },
    targetId: {
      type: Number,
      default: null,
    },
  },
  data: () => ({
    dialogSize: '800px',
    dialogVisible: false,
    form: Object.assign({}, defaultForm),
    errorsServer: [],
    loading: false,
    univTypeList: bodyConfig('constants')['university_type'],
    listCities: [],
  }),
  computed: {
    formRules() {
      return {
        name: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.name'),
            }),
            tiggers: ['change', 'blur'],
          },
          {
            max: 255,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.name'),
              min: 255,
            }),
            triggers: ['change', 'blur'],
          },
        ],
        code: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.code'),
            }),
            tiggers: ['change', 'blur'],
          },
          {
            max: 255,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.code'),
              min: 255,
            }),
            triggers: ['change', 'blur'],
          },
        ],
        type: [
          {
            required: true,
            type: 'number',
            message: this.$t('validate.required', {
              field: this.$t('form.field.type'),
            }),
            tiggers: ['change', 'blur'],
          },
        ],
        city_id: [
          {
            required: true,
            type: 'number',
            message: this.$t('validate.required', {
              field: this.$t('form.field.city'),
            }),
            tiggers: ['change', 'blur'],
          },
        ],
        website: [
          {
            validator: (rule, value, callback) => {
              if (value && value.length && !validURL(value)) {
                callback(
                  new Error(this.$t('validate.valid_format', {
                    field: this.$t('form.field.url'),
                  }))
                );
              } else {
                callback();
              }
            },
            trigger: ['change', 'blur'],
          },
        ],
        phone: [
          {
            validator: (rule, value, callback) => {
              if (value && value.length && !validPhone(value)) {
                callback(
                  new Error(this.$t('validate.valid_format', {
                    field: this.$t('form.field.phone'),
                  }))
                );
              } else {
                callback();
              }
            },
          },
        ],
      };
    },
  },
  watch: {
    'isOpened': function (newVal) {
      this.dialogVisible = newVal;
    },
  },
  created() {
    this.dialogVisible = this.isOpened;
    this.setupForm();
    if (this.targetId) {
      this.getItem(+this.targetId);
    }
  },
  methods: {
    setupForm() {
      staticResource.getCities()
        .then(({ data: { data }}) => {
          this.listCities = data;
        });
    },
    getItem(id) {
      universityResource.get(id)
        .then(({ data: { data }}) => {
          this.form = data;
          this.$emit('open');
        })
        .catch(_ => {
          this.resetRoute();
          this.$message({
            showClose: true,
            message: this.$t('messages.cancel_action'),
            type: 'error',
          });
          this.$emit('close');
        });
    },
    store(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.errorsServer = [];
          universityResource.store(this.form)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.created', {
                  model: (this.$t('model.university')).toLowerCase(),
                }),
                type: 'success',
              });
              this.loading = false;
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
    update(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.errorsServer = [];
          universityResource.update(this.form, this.targetId)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.university')).toLowerCase(),
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
    onBeforeClose() {
      this.resetRoute();
      this.$emit('close');
    },
    resetRoute() {
      if (this.$route.query.edit) {
        this.$router.replace({
          query: {},
        });
      }
    },
  },
};
</script>

<style lang="scss">
@import "@/styles/comps/form-dialog.scss";
</style>
