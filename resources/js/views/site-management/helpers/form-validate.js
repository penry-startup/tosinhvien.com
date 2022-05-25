import { validPhone, validURL } from '@/utils/validate';

const formValidate = _self => ({
  brand_name: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.brand_name'),
      }),
      tiggers: ['change', 'blur'],
    },
    {
      max: 255,
      message: _self.$t('validate.max.string', {
        field: _self.$t('form.field.brand_name'),
        max: 255,
      }),
      triggers: ['change', 'blur'],
    },
  ],
  greeting: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.greeting'),
      }),
      tiggers: ['change', 'blur'],
    },
    {
      max: 255,
      message: _self.$t('validate.max.string', {
        field: _self.$t('form.field.greeting'),
        max: 255,
      }),
      triggers: ['change', 'blur'],
    },
  ],
  top_slogan: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.top_slogan'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  sub_top_slogan: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.sub_top_slogan'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  support_phone: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.support_phone'),
      }),
      tiggers: ['change', 'blur'],
    },
    {
      validator: (rule, value, callback) => {
        if (value && value.length && !validPhone(value)) {
          callback(
            new Error(_self.$t('validate.valid_format', {
              field: _self.$t('form.field.phone'),
            }))
          );
        } else {
          callback();
        }
      },
    },
  ],
  support_email: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.support_email'),
      }),
      tiggers: ['change', 'blur'],
    },
    {
      type: 'email',
      message: _self.$t('validate.email_valid'),
      triggers: ['change', 'blur'],
    },
  ],
  default_sender_email_address: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.default_sender_email_address'),
      }),
      tiggers: ['change', 'blur'],
    },
    {
      type: 'email',
      message: _self.$t('validate.email_valid'),
      triggers: ['change', 'blur'],
    },
  ],
  default_email_sender_name: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.default_email_sender_name'),
      }),
      tiggers: ['change', 'blur'],
    },
    {
      max: 255,
      message: _self.$t('validate.max.string', {
        field: _self.$t('form.field.default_email_sender_name'),
        max: 255,
      }),
      triggers: ['change', 'blur'],
    },
  ],
  facebook_link: [
    {
      validator: (rule, value, callback) => {
        if (value && value.length && !validURL(value)) {
          callback(
            new Error('⚠ Please enter the correct URL format')
          );
        } else {
          callback();
        }
      },
      trigger: ['change', 'blur'],
    },
  ],
  facebook_fanpage_link: [
    {
      validator: (rule, value, callback) => {
        if (value && value.length && !validURL(value)) {
          callback(
            new Error('⚠ Please enter the correct URL format')
          );
        } else {
          callback();
        }
      },
      trigger: ['change', 'blur'],
    },
  ],
  zalo_phone: [
    {
      validator: (rule, value, callback) => {
        if (value && value.length && !validPhone(value)) {
          callback(
            new Error(_self.$t('validate.valid_format', {
              field: _self.$t('form.field.zalo_phone'),
            }))
          );
        } else {
          callback();
        }
      },
    },
  ],
  zalo_group_link: [
    {
      validator: (rule, value, callback) => {
        if (value && value.length && !validURL(value)) {
          callback(
            new Error('⚠ Please enter the correct URL format')
          );
        } else {
          callback();
        }
      },
      trigger: ['change', 'blur'],
    },
  ],
  instagram_link: [
    {
      validator: (rule, value, callback) => {
        if (value && value.length && !validURL(value)) {
          callback(
            new Error('⚠ Please enter the correct URL format')
          );
        } else {
          callback();
        }
      },
      trigger: ['change', 'blur'],
    },
  ],
  youtube_link: [
    {
      validator: (rule, value, callback) => {
        if (value && value.length && !validURL(value)) {
          callback(
            new Error('⚠ Please enter the correct URL format')
          );
        } else {
          callback();
        }
      },
      trigger: ['change', 'blur'],
    },
  ],
  // Meta
  meta_title: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.meta_title'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  meta_descriptions: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.meta_type'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  meta_keywords: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.meta_type'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  meta_type: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.meta_type'),
      }),
      tiggers: ['change', 'blur'],
    },
    {
      max: 255,
      message: _self.$t('validate.max.string', {
        field: _self.$t('form.field.meta_type'),
        max: 255,
      }),
      triggers: ['change', 'blur'],
    },
  ],
  meta_locale: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.meta_locale'),
      }),
      tiggers: ['change', 'blur'],
    },
    {
      max: 255,
      message: _self.$t('validate.max.string', {
        field: _self.$t('form.field.meta_locale'),
        max: 255,
      }),
      triggers: ['change', 'blur'],
    },
  ],
  meta_author: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.meta_author'),
      }),
      tiggers: ['change', 'blur'],
    },
    {
      max: 255,
      message: _self.$t('validate.max.string', {
        field: _self.$t('form.field.meta_author'),
        max: 255,
      }),
      triggers: ['change', 'blur'],
    },
  ],
});

export default formValidate;
