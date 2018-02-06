import requests


class DbControl:
      
        def __init__(self):
            self.__response = None
            self.__a = None

        def get_all(self):
            self.__response = requests.get("http://localhost/Basic-REST-API/public/index.php/get_all")
            self.__a = self.__response.json()
            return self.__a.items()

        def add_student(self, student_id, student_name):
            self.__response = \
                requests.post("http://localhost/Basic-REST-API/public/index.php/add_student/%s/%s"
                              % (student_id, student_name))

            if self.__response.status_code == 200:
                    return "Added"
            else:
                    return "Something vent wrong", self.__response.status_code
      
        def get_names(self):
            self.__response = requests.get("http://localhost/Basic-REST-API/public/index.php/get_names")
            self.__a = self.__response.json()
            return self.__a
