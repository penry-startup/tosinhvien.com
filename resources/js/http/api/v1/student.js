import Resource from '@/http/api/resource';

export default class StudentResource extends Resource {
  constructor() {
    super('/user/student');
  }
}
