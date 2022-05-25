import request from '@/http/request';
import Resource from '@/http/api/resource';

export default class SubjectCombinationGroupResource extends Resource {
  constructor() {
    super('/data-page/subject-combination-group');
  }

  getAll() {
    return request({
      url: `${this.uri}/list/get-all`,
      method: 'get',
    });
  }
}
