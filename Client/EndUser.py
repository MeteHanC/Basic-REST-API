import ApiTest

api = ApiTest.dbControl()


def get_students():
    dictionary = api.get_all()
    for key, value in dictionary:
        print(key, value)


def get_student_names():
    array = api.get_names()
    for value in array:
        print(value)


def add_student():
    student_id = input(" Please enter the student id")
    student_name = input("Please enter the students name")
    returned = api.add_student(student_id, student_name)
    print(returned)
