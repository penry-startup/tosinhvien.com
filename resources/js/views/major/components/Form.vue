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
        <el-form ref="formMajor" :loading="true" :model="form" :rules="formRules" label-position="top">
          <!-- Name Input -->
          <el-form-item :label="$t('form.field.name')" prop="name" :error="getErrorForField('name', errorsServer)" required>
            <el-input v-model="form.name" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.name') })" />
          </el-form-item>

          <!-- Code Input -->
          <el-form-item :label="$t('form.field.code')" prop="code" :error="getErrorForField('code', errorsServer)" required>
            <el-input v-model="form.code" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.code') })" />
          </el-form-item>

          <!-- Thpt score Input -->
          <el-form-item :label="$t('form.field.thpt_score')" prop="thpt_score" :error="getErrorForField('thpt_score', errorsServer)">
            <el-input v-model="form.thpt_score" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.thpt_score') })" />
          </el-form-item>

          <!-- Hocba score Input -->
          <el-form-item :label="$t('form.field.hocba_score')" prop="hocba_score" :error="getErrorForField('hocba_score', errorsServer)">
            <el-input v-model="form.hocba_score" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.hocba_score') })" />
          </el-form-item>

          <!-- Dgnl score Input -->
          <el-form-item :label="$t('form.field.dgnl_score')" prop="dgnl_score" :error="getErrorForField('dgnl_score', errorsServer)">
            <el-input v-model="form.dgnl_score" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.dgnl_score') })" />
          </el-form-item>

          <!-- Subject Group Input -->
          <el-form-item :label="$t('form.field.subject_group')" prop="subject_group" :error="getErrorForField('subject_group', errorsServer)">
            <el-select
              v-model="formTmp.subject_group"
              class="w-100"
              multiple
              filterable
              allow-create
              default-first-option
              :placeholder="$t('form.placeholder.select', {
                field: $t('form.field.subject_group')
              })"
            >
              <el-option
                v-for="(item, index) in recommendSubjectGroup"
                :key="index"
                :value="item"
                :label="item"
              />
            </el-select>
          </el-form-item>

          <!-- University Input -->
          <el-form-item :label="$t('form.field.university')" prop="university_id" :error="getErrorForField('university_id', errorsServer)" required>
            <el-select v-model="form.university_id" filterable :placeholder="$t('form.placeholder.select', { field: $t('form.field.university') })" class="w-100">
              <el-option
                v-for="university in listUniversities"
                :key="university.id"
                :label="university.name"
                :value="+university.id"
              />
            </el-select>
          </el-form-item>

          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              v-if="!$route.query.edit"
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="store('formMajor')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formMajor')"
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
import Cookie from 'js-cookie';
import MajorResource from '@/http/api/v1/major';
import UniversityResource from '@/http/api/v1/university';
import { CONST_COOKIE } from '@/config/constants';

const majorResource = new MajorResource();
const universityResource = new UniversityResource();
const defaultForm = {
  name: '',
  code: '',
  subject_group: '',
  thpt_score: '',
  hocba_score: '',
  dgnl_score: '',
  university_id: '',
};

export default {
  name: 'FormMajor',
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
    formTmp: {
      subject_group: [],
    },
    errorsServer: [],
    loading: false,
    listUniversities: [],
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
        subject_group: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.subject_group'),
            }),
            tiggers: ['change', 'blur'],
          },
          {
            max: 255,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.subject_group'),
              min: 255,
            }),
            triggers: ['change', 'blur'],
          },
        ],
        thpt_score: [
          {
            validator: (rule, value, callback) => {
              if (value && value.length && isNaN(value)) {
                callback(
                  new Error(this.$t('validate.numeric', {
                    field: this.$t('form.field.thpt_score'),
                  })
                ));
              } else {
                callback();
              }
            },
          },
        ],
        hocba_score: [
          {
            validator: (rule, value, callback) => {
              if (value && value.length && isNaN(value)) {
                callback(
                  new Error(this.$t('validate.numeric', {
                    field: this.$t('form.field.hocba_score'),
                  })
                ));
              } else {
                callback();
              }
            },
          },
        ],
        dgnl_score: [
          {
            validator: (rule, value, callback) => {
              if (value && value.length && isNaN(value)) {
                callback(
                  new Error(this.$t('validate.numeric', {
                    field: this.$t('form.field.dgnl_score'),
                  })
                ));
              } else {
                callback();
              }
            },
          },
        ],
        university_id: [
          {
            required: true,
            type: 'number',
            message: this.$t('validate.required', {
              field: this.$t('form.field.university'),
            }),
            tiggers: ['change', 'blur'],
          },
        ],
      };
    },
    recommendSubjectGroup() {
      return Cookie.get(CONST_COOKIE.sject_grp)
            ? JSON.parse(Cookie.get(CONST_COOKIE.sject_grp))
            : [];
    },
  },
  watch: {
    'isOpened': function (newVal) {
      this.dialogVisible = newVal;
    },
    'formTmp.subject_group': function (sjectGrps) {
      const subjectGroupSaved = Cookie.get(CONST_COOKIE.sject_grp) ? JSON.parse(Cookie.get(CONST_COOKIE.sject_grp)) : [];
      const sjectGrpFiltered = sjectGrps && sjectGrps.filter(sjectGrp => {
        return !subjectGroupSaved.includes(sjectGrp);
      });
      Cookie.set(CONST_COOKIE.sject_grp, JSON.stringify([
        ...subjectGroupSaved,
        ...sjectGrpFiltered,
      ]), { expires: 1 });
      this.form.subject_group = sjectGrps.join('; ');
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
      universityResource.getUniversities()
        .then(({ data: { data }}) => {
          this.listUniversities = data;
        });
    },
    getItem(id) {
      majorResource.get(id)
        .then(({ data: { data }}) => {
          const { id, name, code, subject_group, thpt_score, hocba_score, dgnl_score, university_id } = data;
          this.form = { id, name, code, subject_group, thpt_score, hocba_score, dgnl_score, university_id };
          this.formTmp.subject_group = subject_group.split('; ');
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
          majorResource.store(this.form)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.created', {
                  model: (this.$t('model.major')).toLowerCase(),
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
          majorResource.update(this.form, this.targetId)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.major')).toLowerCase(),
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
