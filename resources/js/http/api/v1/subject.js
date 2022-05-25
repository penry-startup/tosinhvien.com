import request from '@/http/request';
import Resource from '@/http/api/resource';

export default class SubjectResource extends Resource {
  constructor() {
    super('/data-page/subject');
  }

  getAll() {
    return request({
      url: `${this.uri}/list/get-all`,
      method: 'get',
    });
  }
}
