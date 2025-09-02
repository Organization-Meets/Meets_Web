# ---- Build do frontend ----
FROM node:20 AS frontend-build
WORKDIR /app
COPY ../frontend/ .
RUN npm install && npm run build

# ---- Build do backend ----
FROM maven:3.9.6-eclipse-temurin-21 AS backend-build
WORKDIR /app
COPY . .
# copia o build do frontend para dentro do Spring Boot
COPY --from=frontend-build /app/dist ./src/main/resources/static
RUN mvn clean package -DskipTests

# ---- Imagem final ----
FROM eclipse-temurin:21-jdk
WORKDIR /app
COPY --from=backend-build /app/target/*.jar app.jar
EXPOSE 8080
ENTRYPOINT ["java", "-jar", "app.jar"]
