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
        <el-form ref="formStudent" :loading="true" :model="form" :rules="formRules" label-position="top">
          <!-- Name Input -->
          <el-form-item :label="$t('form.field.name')" prop="name" :error="getErrorForField('name', errorsServer)" required>
            <el-input v-model="form.name" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.name') })" />
          </el-form-item>

          <!-- Sex Input -->
          <el-form-item :label="$t('form.field.sex')" prop="sex" :error="getErrorForField('sex', errorsServer)" required>
            <el-select v-model="form.sex" :placeholder="$t('form.placeholder.select', { field: $t('form.field.sex') })" class="w-100">
              <el-option :label="serverConfig['sex']['label']['1']" :value="serverConfig['sex']['key']['male']" />
              <el-option :label="serverConfig['sex']['label']['2']" :value="serverConfig['sex']['key']['female']" />
              <el-option :label="serverConfig['sex']['label']['3']" :value="serverConfig['sex']['key']['lgbt']" />
            </el-select>
          </el-form-item>

          <!-- Email Input -->
          <el-form-item :label="$t('form.field.email')" prop="email" :error="getErrorForField('email', errorsServer)" required>
            <el-input v-model="form.email" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.email') })" />
          </el-form-item>

          <!-- Phone Input -->
          <el-form-item :label="$t('form.field.phone')" prop="phone" :error="getErrorForField('phone', errorsServer)">
            <el-input v-model="form.phone" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone') })" />
          </el-form-item>

          <!-- Is Active Input -->
          <el-form-item :label="$t('form.field.is_active')" prop="is_active" :error="getErrorForField('is_active', errorsServer)" required>
            <el-select v-model="form.is_active" :placeholder="$t('form.placeholder.select', { field: $t('form.field.is_active') })" class="w-100">
              <el-option :label="serverConfig['is_active']['label']['1']" :value="+serverConfig['is_active']['key']['active']" />
              <el-option :label="serverConfig['is_active']['label']['0']" :value="+serverConfig['is_active']['key']['inactive']" />
            </el-select>
          </el-form-item>

          <!-- Is Draft Input -->
          <el-form-item :label="$t('form.field.is_draft')" prop="is_draft" :error="getErrorForField('is_draft', errorsServer)" required>
            <el-select v-model="form.is_draft" :placeholder="$t('form.placeholder.select', { field: $t('form.field.is_draft') })" class="w-100">
              <el-option v-if="form.is_draft" :label="serverConfig['is_draft']['label']['1']" :value="+serverConfig['is_draft']['key']['is_draft']" />
              <el-option v-else :label="serverConfig['is_draft']['label']['0']" :value="+serverConfig['is_draft']['key']['is_real']" />
            </el-select>
          </el-form-item>

          <!-- Password Input -->
          <template v-if="!$route.query.edit">
            <el-form-item :label="$t('form.field.password')" prop="password" :error="getErrorForField('password', errorsServer)">
              <el-input v-model="form.password" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.password') })" show-password />
            </el-form-item>
          </template>

          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              v-if="!$route.query.edit"
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="store('formStudent')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formStudent')"
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
import StudentResource from '@/http/api/v1/student';
import { bodyConfig } from '@/utils/helpers';
import { validPhone, validPassword } from '@/utils/validate';

const studentResource = new StudentResource();
const defaultForm = {
  name: '',
  sex: 1,
  email: '',
  phone: '',
  is_active: 1,
  is_draft: 1,
  password: '',
};

export default {
  name: 'FormStudent',
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
    serverConfig: {
      sex: bodyConfig('constants')['sex'],
      is_active: bodyConfig('constants')['is_active'],
      is_draft: bodyConfig('constants')['is_draft'],
    },
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
              max: 255,
            }),
            triggers: ['change', 'blur'],
          },
        ],
        email: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.email'),
            }),
            tiggers: ['change', 'blur'],
          },
          {
            type: 'email',
            message: this.$t('validate.email_valid'),
            triggers: ['change', 'blur'],
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
        password: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.password'),
            }),
            tiggers: ['change', 'blur'],
          },
          {
            validator: (rule, value, callback) => {
              if (!validPassword(value)) {
                callback(
                  new Error(this.$t('validate.password_valid'))
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
    if (this.targetId) {
      this.getItem(+this.targetId);
    }
  },
  methods: {
    getItem(id) {
      studentResource.get(id)
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
          studentResource.store(this.form)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.created', {
                  model: (this.$t('model.student')).toLowerCase(),
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
          // Remove password field from form
          delete this.form.password;
          studentResource.update(this.form, this.targetId)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.student')).toLowerCase(),
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
