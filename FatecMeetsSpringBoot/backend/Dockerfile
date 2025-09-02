# ===============================
# Etapa 1: Build do frontend
# ===============================
FROM node:20 AS frontend-build
WORKDIR /frontend
COPY frontend/package*.json ./
RUN npm install
COPY frontend/ .
RUN npm run build

# ===============================
# Etapa 2: Build do backend (Spring Boot)
# ===============================
FROM eclipse-temurin:21-jdk AS backend-build
WORKDIR /app
COPY backend/ ./backend/
COPY --from=frontend-build /frontend/dist ./backend/src/main/resources/static/
WORKDIR /app/backend
RUN ./mvnw -B package -DskipTests

# ===============================
# Etapa 3: Runtime
# ===============================
FROM eclipse-temurin:21-jre
WORKDIR /app
COPY --from=backend-build /app/backend/target/*.jar app.jar
EXPOSE 8080
ENTRYPOINT ["java", "-jar", "app.jar"]
