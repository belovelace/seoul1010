# 2024 서울 AIOT 해커톤 우수상 작품  
**주최:** 서울시  
**수상 내역:** 서울특별시장상 및 상금  

---

## 팀 구성: **잘풀리는 팀** 🎉  
- **박철민** (조장) – 하드웨어 | [asdflkjh@naver.com](mailto:asdflkjh@naver.com)  
- **신은지** – 소프트웨어 | [eunji7480@gachon.ac.kr](mailto:eunji7480@gachon.ac.kr)  
- **홍근재** – 하드웨어 | [qazxsw215@naver.com](mailto:qazxsw215@naver.com)  
- **변경수** – 하드웨어 | [wntkdnl2000@naver.com](mailto:wntkdnl2000@naver.com)  

---

## 프로젝트 소개  
**아두이노 초음파 센서를 활용한 실시간 화장실 휴지 잔량 모니터링 시스템**  

이 프로젝트는 아두이노 **초음파 센서**를 통해 화장실의 휴지 잔량을 실시간으로 측정하고 서버에 데이터를 전송하여 데이터베이스에 업데이트하는 시스템입니다.  
사용자들은 **반응형 웹 디자인**을 통해 다양한 기기에서 손쉽게 조회할 수 있으며, **관리자**는 웹 애플리케이션을 통해 화장실 상태를 실시간으로 확인하고 휴지 부족 문제를 예방할 수 있습니다.  

---

## 기대 효과 및 실현 가능성  
- **방문객 만족도** 향상: 휴지 부족으로 인한 불편함 방지  
- **관리 효율성 증대**: 관리자가 실시간으로 상태를 모니터링하며 효율적인 운영 가능  
- **서울시 공원 내 Wi-Fi 사업**과 연계: 시스템 설치 및 환경 구축이 용이  

---

## 발전 방향  
- **칩 설계를 통한 모듈 통합**  
  - 여러 모듈을 하나의 칩으로 통합 설계하여 시스템의 일관성을 높이고, 대량 생산으로 제조 비용을 절감해 경쟁력을 강화할 수 있습니다.  

- **데이터 분석 및 통계 제공**  
  - 화장실 이용 패턴과 휴지 소모량을 분석해 **통계 데이터**를 제공하고, 공원 관리 및 운영에 활용하여 효율성을 극대화할 수 있습니다.  

---

## 하드웨어 구성  
- **Arduino Uno R4 WIFI**  
- **HC-SR04 초음파 센서**  

![Arduino Uno R4 WIFI](https://github.com/user-attachments/assets/1bab0d82-d3f4-41f3-a935-068108dd1f1a)  
![HC-SR04 Sensor](https://github.com/user-attachments/assets/1ab2b986-513a-439b-bc28-a3f2c4f2d674)  

---

## 소프트웨어 구성  
- **툴 도구**:  
  - ERD Cloud, Sourcetree, IntelliJ IDEA, XAMPP  

- **라이브러리**:  
  - Spring, Lombok, MyBatis  

- **프레임워크 및 언어**:  
  - Spring Boot, JSP, CSS, Java, MySQL, JavaScript, HTML  

---

## 설치 및 실행 방법  
1. **Arduino Uno R4**와 **HC-SR04** 센서를 연결합니다.  
2. 소스 코드를 컴파일하여 아두이노에 업로드합니다.  
3. XAMPP를 통해 로컬 서버를 실행합니다.  
4. 데이터베이스(MySQL)를 초기화하고 테이블을 생성합니다.  
5. Spring Boot 애플리케이션을 IntelliJ IDEA에서 빌드 및 실행합니다.  

---

## 기여 방법  
1. 이 프로젝트를 포크합니다.  
2. 새로운 기능을 개발하고, 버그를 수정합니다.  
3. 변경 사항을 커밋하고 Pull Request를 생성합니다.  

---

## 라이선스  
이 프로젝트는 **MIT License**에 따라 배포됩니다.  

---

## 문의  
프로젝트 관련 문의는 아래 이메일로 연락 부탁드립니다.  
- [eunji7480@gachon.ac.kr](mailto:eunji7480@gachon.ac.kr)
