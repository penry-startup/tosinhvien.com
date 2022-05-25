import request from '@/http/request';
import Resource from '@/http/api/resource';

export default class SiteManagementResource extends Resource {
  constructor() {
    super('/settings/site-management');
  }

  show() {
    return request({
      url: `${this.uri}/show`,
      method: 'get',
    });
  }

  update(resource) {
    return request({
      url: `${this.uri}/update`,
      method: 'POST',
      data: resource,
      params: {
        _method: 'PUT',
      },
      headers: {
        'Content-type': 'multipart/form-data',
      },
    });
  }
}
