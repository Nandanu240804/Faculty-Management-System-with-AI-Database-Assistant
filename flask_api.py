from flask import Flask, request, jsonify
import mysql.connector
import re

app = Flask(__name__)

# Database connection
def db_connection():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="faculty_management"
    )

# Smart query handler
@app.route('/query', methods=['POST'])
def query():
    data = request.json
    question = data.get('question', '').lower().strip()  # Normalize the input

    conn = db_connection()
    cursor = conn.cursor(dictionary=True)

    # Check if the question is about the total number of teachers
    if re.search(r'\b(total|how many|number of|count of)\b.*\b(teachers?)\b', question):
        cursor.execute("SELECT COUNT(*) AS total_teachers FROM teachers")
        result = cursor.fetchone()
        answer = f"There are {result['total_teachers']} teachers."
    
    # Check if the question is about a specific teacher
    elif re.search(r'\b(who is)\b', question):
        name = re.sub(r'\b(who is)\b', '', question).strip()  # Extract the name
        cursor.execute("SELECT name, department, phone, email FROM teachers WHERE name = %s", (name,))
        teacher = cursor.fetchone()
        if teacher:
            answer = f"{teacher['name']} is in {teacher['department']} department. Contact: {teacher['phone']} | {teacher['email']}."
        else:
            answer = f"I couldn't find {name} in the database."

    # Default response for unrecognized questions
    else:
        answer = "I didn't understand your question. Please try asking something like 'How many teachers are there?' or 'Who is Nandan?'"

    conn.close()
    return jsonify({"answer": answer})

if __name__ == '__main__':
    app.run(debug=True, port=5000)